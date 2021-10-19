<?php declare( strict_types = 1 );
namespace CodeKandis\Session;

use CodeKandis\Session\Configurations\SessionsConfigurationInterface;
use function array_key_exists;
use function is_dir;
use function session_destroy;
use function session_name;
use function session_regenerate_id;
use function session_start;
use function session_status;
use function session_unset;
use function session_write_close;
use function sprintf;

/**
 * Represents a class handling sessions.
 * @package codekandis/session
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionHandler implements SessionHandlerInterface
{
	/**
	 * Represents the error message if the session directory does not exist.
	 * @var string
	 */
	protected const ERROR_SESSION_DIRECTORY_NOT_FOUND = 'The session directory \'%s\' does not exist.';

	/**
	 * Represents the error message if the session directory is not writable.
	 * @var string
	 */
	protected const ERROR_SESSION_DIRECTORY_NOT_WRITABLE = 'The session directory \'%s\' is not writable.';

	/**
	 * Represents the error message if the session has not been started.
	 * @var string
	 */
	protected const ERROR_SESSION_HAS_NOT_BEEN_STARTED = 'The session has not been started.';

	/**
	 * Represents the error message if the session has not been started.
	 * @var string
	 */
	protected const ERROR_SESSION_HAS_BEEN_STARTED = 'The session has already been started.';

	/**
	 * Represents the error message if a session key does not exist.
	 * @var string
	 */
	protected const ERROR_SESSION_KEY_DOES_NOT_EXIST = 'The session key \'%s\' does not exist.';

	/**
	 * Stores the sessions configuration.
	 * @var SessionsConfigurationInterface
	 */
	private SessionsConfigurationInterface $configuration;

	/**
	 * Constructor method.
	 * @param SessionsConfigurationInterface $configuration The sessions configuration.
	 */
	public function __construct( SessionsConfigurationInterface $configuration )
	{
		$this->configuration = $configuration;
	}

	/**
	 * Sets the path where the session data will be stored.
	 * @throws SessionStartedException The session has already been started.
	 * @throws SessionDirectoryNotFoundException The session directory does not exist.
	 * @throws SessionDirectoryNotWritableException The session directory is not writable.
	 */
	private function setSavePath(): void
	{
		if ( null === $this->configuration->getSavePath() )
		{
			return;
		}

		if ( false === is_dir( $this->configuration->getSavePath() ) )
		{
			throw new SessionDirectoryNotFoundException(
				sprintf(
					static::ERROR_SESSION_DIRECTORY_NOT_FOUND,
					$this->configuration->getSavePath()
				)
			);
		}

		if ( false === is_writable( $this->configuration->getSavePath() ) )
		{
			throw new SessionDirectoryNotWritableException(
				sprintf(
					static::ERROR_SESSION_DIRECTORY_NOT_WRITABLE,
					$this->configuration->getSavePath()
				)
			);
		}

		if ( SessionStatus::ACTIVE === $this->getStatus() )
		{
			throw new SessionStartedException( static::ERROR_SESSION_HAS_BEEN_STARTED );
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getStatus(): int
	{
		return session_status();
	}

	/**
	 * {@inheritdoc}
	 */
	public function start(): bool
	{
		if ( SessionStatus::ACTIVE === $this->getStatus() )
		{
			throw new SessionStartedException( static::ERROR_SESSION_HAS_BEEN_STARTED );
		}

		$this->setSavePath();

		return session_start( $this->configuration->getSavePath() );
	}

	/**
	 * {@inheritdoc}
	 */
	public function destroy(): bool
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		session_unset();

		return session_destroy();
	}

	/**
	 * {@inheritdoc}
	 */
	public function writeClose(): void
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		session_write_close();
	}

	/**
	 * {@inheritdoc}
	 */
	public function regenerateId( bool $deleteOldSession = false ): bool
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		return session_regenerate_id( $deleteOldSession );
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName(): string
	{
		return session_name();
	}

	/**
	 * {@inheritdoc}
	 */
	public function setName( string $name ): void
	{
		session_name( $name );
	}

	/**
	 * {@inheritdoc}
	 */
	public function has( string $key ): bool
	{
		if ( SessionStatus::ACTIVE === $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		return array_key_exists( $key, $_SESSION );
	}

	/**
	 * {@inheritdoc}
	 */
	public function get( string $key )
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		if ( false === $this->has( $key ) )
		{
			throw new SessionKeyNotFoundException(
				sprintf(
					static::ERROR_SESSION_KEY_DOES_NOT_EXIST,
					$key
				)
			);
		}

		return $_SESSION[ $key ];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDefaulted( string $key, $value )
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		if ( false === $this->has( $key ) )
		{
			return $_SESSION[ $key ] = $value;
		}

		return $_SESSION[ $key ];
	}

	/**
	 * {@inheritdoc}
	 */
	public function set( string $key, $value ): void
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		$_SESSION[ $key ] = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function unset( string $key ): void
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_HAS_NOT_BEEN_STARTED );
		}

		if ( false === $this->has( $key ) )
		{
			throw new SessionKeyNotFoundException(
				sprintf(
					static::ERROR_SESSION_KEY_DOES_NOT_EXIST,
					$key
				)
			);
		}

		unset( $_SESSION[ $key ] );
	}
}

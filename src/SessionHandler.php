<?php declare( strict_types = 1 );
namespace CodeKandis\Session;

use CodeKandis\Session\Configurations\SessionsConfigurationInterface;
use function array_key_exists;
use function is_dir;
use function is_writable;
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
	protected const ERROR_SESSION_NOT_STARTED = 'The session has not been started.';

	/**
	 * Represents the error message if the session has not been started.
	 * @var string
	 */
	protected const ERROR_SESSION_STARTED = 'The session has already been started.';

	/**
	 * Represents the error message if a session key does not exist.
	 * @var string
	 */
	protected const ERROR_SESSION_KEY_NOT_FOUND = 'The session key \'%s\' does not exist.';

	/**
	 * Represents the error message if the session has been failed to start.
	 * @var string
	 */
	protected const ERROR_SESSION_START_FAILED = 'The session has been failed to start.';

	/**
	 * Represents the error message if the session has been failed to unset.
	 * @var string
	 */
	protected const ERROR_SESSION_UNSET_FAILED = 'The session has been failed to unset.';

	/**
	 * Represents the error message if the session has been failed to destroy.
	 * @var string
	 */
	protected const ERROR_SESSION_DESTROY_FAILED = 'The session has been failed to destroy.';

	/**
	 * Represents the error message if the session has been failed to write-close.
	 * @var string
	 */
	protected const ERROR_SESSION_WRITE_CLOSE_FAILED = 'The session has been failed to write-close.';

	/**
	 * Represents the error message if the session has been failed to regenerate its ID.
	 * @var string
	 */
	protected const ERROR_SESSION_REGENERATE_ID_FAILED = 'The session has been failed to regenerate its ID.';

	/**
	 * Represents the error message if the session has been failed to set its name.
	 * @var string
	 */
	protected const ERROR_SESSION_SET_NAME_FAILED = 'The session has been failed to set its name.';

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
			throw new SessionStartedException( static::ERROR_SESSION_STARTED );
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
	public function start(): void
	{
		if ( SessionStatus::ACTIVE === $this->getStatus() )
		{
			throw new SessionStartedException( static::ERROR_SESSION_STARTED );
		}

		$this->setSavePath();

		if ( false === session_start() )
		{
			throw new SessionStartFailedException( static::ERROR_SESSION_START_FAILED );
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function destroy(): void
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
		}

		if ( false === session_unset() )
		{
			throw new SessionUnsetFailedException( static::ERROR_SESSION_UNSET_FAILED );
		}
		if ( false === session_destroy() )
		{
			throw new SessionDestroyFailedException( static::ERROR_SESSION_DESTROY_FAILED );
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function writeClose(): void
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
		}

		if ( false === session_write_close() )
		{
			throw new SessionWriteCloseFailedException( static::ERROR_SESSION_WRITE_CLOSE_FAILED );
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function regenerateId( bool $deleteOldSession = false ): void
	{
		if ( SessionStatus::ACTIVE !== $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
		}

		if ( false === session_regenerate_id( $deleteOldSession ) )
		{
			throw new SessionRegenerateIdFailedException( static::ERROR_SESSION_REGENERATE_ID_FAILED );
		}
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
		if ( false === session_name( $name ) )
		{
			throw new SessionSetNameFailedException( static::ERROR_SESSION_SET_NAME_FAILED );
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function has( string $key ): bool
	{
		if ( SessionStatus::ACTIVE === $this->getStatus() )
		{
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
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
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
		}

		if ( false === $this->has( $key ) )
		{
			throw new SessionKeyNotFoundException(
				sprintf(
					static::ERROR_SESSION_KEY_NOT_FOUND,
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
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
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
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
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
			throw new SessionNotStartedException( static::ERROR_SESSION_NOT_STARTED );
		}

		if ( false === $this->has( $key ) )
		{
			throw new SessionKeyNotFoundException(
				sprintf(
					static::ERROR_SESSION_KEY_NOT_FOUND,
					$key
				)
			);
		}

		unset( $_SESSION[ $key ] );
	}
}

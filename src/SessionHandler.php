<?php declare( strict_types = 1 );
namespace CodeKandis\Session;

use function array_key_exists;
use function session_destroy;
use function session_name;
use function session_regenerate_id;
use function session_save_path;
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
	 * Stores the session configuration directives.
	 * @var array
	 */
	private array $options;

	/**
	 * Stores the path where the session will be stored.
	 * @var ?string
	 */
	private string $savePath;

	/**
	 * Constructor method.
	 * @param array $options The session configuration directives.
	 * @param ?string $savePath The path where the session data will be saved.
	 */
	public function __construct( array $options = [], ?string $savePath = null )
	{
		$this->options  = $options;
		$this->savePath = $savePath;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSavePath(): ?string
	{
		if ( SessionStatus::ACTIVE === $this->getStatus() )
		{
			throw new SessionStartedException( static::ERROR_SESSION_HAS_BEEN_STARTED );
		}

		return session_save_path();
	}

	/**
	 * {@inheritdoc}
	 */
	public function setSavePath( ?string $savePath ): void
	{
		if ( SessionStatus::ACTIVE === $this->getStatus() )
		{
			throw new SessionStartedException( static::ERROR_SESSION_HAS_BEEN_STARTED );
		}

		$this->savePath = $savePath;
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

		session_save_path( $this->savePath );

		return session_start( $this->options );
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

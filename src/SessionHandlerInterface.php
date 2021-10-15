<?php declare( strict_types = 1 );
namespace CodeKandis\Session;

/**
 * Represents the interface of all session handler managing sessions.
 * @package codekandis/session
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SessionHandlerInterface
{
	/**
	 * Gets the path where the session data will be stored.
	 * @return string The path where the session data will be stored.
	 * @throws SessionStartedException The session has already been started.
	 */
	public function getSavePath(): ?string;

	/**
	 * Sets the path where the session data will be stored.
	 * @param ?string $savePath The path where the session data will be stored.
	 * @throws SessionStartedException The session has already been started.
	 */
	public function setSavePath( ?string $savePath ): void;

	/**
	 * Gets the status of the current session.
	 * @return int WorkANicer_Client_SessionStatus::DISABLED if sessions are disabled, WorkANicer_Client_SessionStatus::NONE if sessions are enabled, but none exists, WorkANicer_Client_SessionStatus::ACTIVE if sessions are enabled and one exists.
	 */
	public function getStatus(): int;

	/**
	 * Start a new or resumes an existing session.
	 * @return bool True if the session has been started or resumed successfully, false otherwise.
	 * @throws SessionStartedException The session has already been started.
	 */
	public function start(): bool;

	/**
	 * Destroys all data registered to a session.
	 * @return bool True if the registered data has been destroyed successfully, false otherwise.
	 * @throws SessionNotStartedException The session has not been started.
	 */
	public function destroy(): bool;

	/**
	 * Writes and closes a session.
	 * @throws SessionNotStartedException The session has not been started.
	 */
	public function writeClose(): void;

	/**
	 * Replaces the old session ID with a new one.
	 * @param bool $deleteOldSession [false] Specifies if the old session should be deleted.
	 * @return bool True if the session ID has been replaced successfully, false otherwise.
	 * @throws SessionNotStartedException The session has not been started.
	 */
	public function regenerateId( bool $deleteOldSession = false ): bool;

	/**
	 * Gets the name of the session.
	 * @return string The name of the session.
	 */
	public function getName(): string;

	/**
	 * Sets the name of the session.
	 * @param string $name The name of the session.
	 */
	public function setName( string $name ): void;

	/**
	 * Determines if the session has a specific key value pair.
	 * @param string $key The key to determine if it exists.
	 * @return bool True if the session has the specific key value pair, false otherwise.
	 * @throws SessionNotStartedException The session has not been started.
	 */
	public function has( string $key ): bool;

	/**
	 * Gets a value from the session.
	 * @param string $key The key to get its value from the session.
	 * @return mixed The value from the session.
	 * @throws SessionNotStartedException The session has not been started.
	 * @throws SessionKeyNotFoundException The passed key does not exist.
	 */
	public function get( string $key );

	/**
	 * Gets a value from the session or a specific default value, if the key value pair does not exist. The default value will be set instead.
	 * @param string $key The key to get its value from the session.
	 * @param mixed $default The default value if the key value pair does not exist.
	 * @return mixed The value from the session.
	 * @throws SessionNotStartedException The session has not been started.
	 */
	public function getDefaulted( string $key, $default );

	/**
	 * Sets a value of the session.
	 * @param string $key The key to set its value to the session.
	 * @param mixed $value The value to set to the session.
	 * @throws SessionNotStartedException The session has not been started.
	 */
	public function set( string $key, $value ): void;

	/**
	 * Unsets a value from the session.
	 * @param string $key The key to unset its value from the session.
	 * @throws SessionNotStartedException The session has not been started.
	 * @throws SessionKeyNotFoundException The passed key does not exist.
	 */
	public function unset( string $key ): void;
}

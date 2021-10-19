<?php declare( strict_types = 1 );
namespace CodeKandis\Session\Configurations;

/**
 * Represents the interface of any sessions configuration.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SessionsConfigurationInterface
{
	/**
	 * Gets the session options.
	 * @return array The session options.
	 */
	public function getOptions(): array;

	/**
	 * Gets the path where to save the sessions.
	 * @return ?string The path where to save the sessions.
	 */
	public function getSavePath(): ?string;
}

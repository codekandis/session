<?php declare( strict_types = 1 );
namespace CodeKandis\Session\Configurations;

/**
 * Represents a sessions configuration.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionsConfiguration implements SessionsConfigurationInterface
{
	/**
	 * Stores the session options.
	 * @var array
	 */
	private array $options = [];

	/**
	 * Stores the path where to save the sessions.
	 * @var ?string
	 */
	private ?string $savePath = null;

	/**
	 * {@inheritDoc}
	 */
	public function getOptions(): array
	{
		return $this->options;
	}

	/**
	 * Gets the session options.
	 * @param array $options The session options.
	 */
	public function setOptions( array $options ): void
	{
		$this->options = $options;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getSavePath(): ?string
	{
		return $this->savePath;
	}

	/**
	 * Gets the path where to save the sessions.
	 * @param ?string $savePath The path where to save the sessions.
	 */
	public function setSavePath( ?string $savePath ): void
	{
		$this->savePath = $savePath;
	}
}

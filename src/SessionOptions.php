<?php declare( strict_types = 1 );
namespace CodeKandis\Session;

/**
 * Represents the session configuration directives.
 * @package codekandis/session
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class SessionOptions
{
	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SAVE_PATH = 'save_path';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const NAME = 'name';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SAVE_HANDLER = 'save_handler';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const AUTO_START = 'auto_start';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const GC_PROBABILITY = 'gc_probability';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const GC_DIVISOR = 'gc_divisor';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const GC_MAXLIFETIME = 'gc_maxlifetime';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SERIALIZE_HANDLER = 'serialize_handler';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_LIFETIME = 'cookie_lifetime';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_PATH = 'cookie_path';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_DOMAIN = 'cookie_domain';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_SECURE = 'cookie_secure';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_HTTPONLY = 'cookie_httponly';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_SAMESITE = 'cookie_samesite';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_STRICT_MODE = 'use_strict_mode';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_COOKIES = 'use_cookies';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_ONLY_COOKIES = 'use_only_cookies';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const REFERER_CHECK = 'referer_check';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const CACHE_LIMITER = 'cache_limiter';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const CACHE_EXPIRE = 'cache_expire';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_TRANS_SID = 'use_trans_sid';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const TRANS_SID_TAGS = 'trans_sid_tags';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const TRANS_SID_HOSTS = 'trans_sid_hosts';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SID_LENGTH = 'sid_length';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SID_BITS_PER_CHARACTER = 'sid_bits_per_character';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_ENABLED = 'upload_progress.enabled';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_CLEANUP = 'upload_progress.cleanup';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_PREFIX = 'upload_progress.prefix';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_NAME = 'upload_progress.name';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_FREQ = 'upload_progress.freq';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_MIN_FREQ = 'upload_progress.min_freq';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const LAZY_WRITE = 'lazy_write';
}

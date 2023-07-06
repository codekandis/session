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
	public const SAVE_PATH = 'session.save_path';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const NAME = 'session.name';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SAVE_HANDLER = 'session.save_handler';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const AUTO_START = 'session.auto_start';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const GC_PROBABILITY = 'session.gc_probability';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const GC_DIVISOR = 'session.gc_divisor';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const GC_MAXLIFETIME = 'session.gc_maxlifetime';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SERIALIZE_HANDLER = 'session.serialize_handler';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_LIFETIME = 'session.cookie_lifetime';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_PATH = 'session.cookie_path';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_DOMAIN = 'session.cookie_domain';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_SECURE = 'session.cookie_secure';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_HTTPONLY = 'session.cookie_httponly';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const COOKIE_SAMESITE = 'session.cookie_samesite';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_STRICT_MODE = 'session.use_strict_mode';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_COOKIES = 'session.use_cookies';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_ONLY_COOKIES = 'session.use_only_cookies';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const REFERER_CHECK = 'session.referer_check';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const CACHE_LIMITER = 'session.cache_limiter';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const CACHE_EXPIRE = 'session.cache_expire';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const USE_TRANS_SID = 'session.use_trans_sid';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const TRANS_SID_TAGS = 'session.trans_sid_tags';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const TRANS_SID_HOSTS = 'session.trans_sid_hosts';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SID_LENGTH = 'session.sid_length';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const SID_BITS_PER_CHARACTER = 'session.sid_bits_per_character';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_ENABLED = 'session.upload_progress.enabled';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_CLEANUP = 'session.upload_progress.cleanup';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_PREFIX = 'session.upload_progress.prefix';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_NAME = 'session.upload_progress.name';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_FREQ = 'session.upload_progress.freq';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const UPLOAD_PROGRESS_MIN_FREQ = 'session.upload_progress.min_freq';

	/**
	 * @see https://www.php.net/manual/en/session.configuration.php
	 * @var string
	 */
	public const LAZY_WRITE = 'session.lazy_write';
}

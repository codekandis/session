<?php declare( strict_types = 1 );
namespace CodeKandis\Session;

use LogicException;

/**
 * Represents an exception if a session key does not exist.
 * @package codekandis/session
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionKeyNotFoundException extends LogicException
{
}

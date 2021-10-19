<?php declare( strict_types = 1 );
namespace CodeKandis\Session;

use LogicException;

/**
 * Represents an exception if a session has been failed to unset.
 * @package codekandis/session
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionUnsetFailedException extends LogicException
{
}

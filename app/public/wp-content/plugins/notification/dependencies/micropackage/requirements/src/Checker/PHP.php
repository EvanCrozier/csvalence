<?php
/**
 * PHP Checker class
 *
 * @package micropackage/requirements
 *
 * @license GPL-3.0-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\Dependencies\Micropackage\Requirements\Checker;

use BracketSpace\Notification\Dependencies\Micropackage\Requirements\Abstracts;
use BracketSpace\Notification\Dependencies\Micropackage\Requirements\Requirements;

/**
 * PHP Checker class
 */
class PHP extends Abstracts\Checker {

	/**
	 * Checker name
	 *
	 * @var string
	 */
	protected $name = 'php';

	/**
	 * Checks if the requirement is met
	 *
	 * @since  1.0.0
	 * @throws \Exception When provided value is not a string or numeric.
	 * @param  string $value Required PHP version.
	 * @return void
	 */
	public function check( $value ) {

		if ( ! is_string( $value ) && ! is_numeric( $value ) ) {
			throw new \Exception( 'PHP Check requires numeric or string parameter' );
		}

		$php_version = phpversion();

		if ( version_compare( $php_version, $value, '<' ) ) {
			$this->add_error( sprintf(
				// Translators: 1. Required PHP version, 2. Used PHP version.
				__( 'Minimum required version of PHP is %1$s. Your version is %2$s', Requirements::$textdomain ),
				$value,
				$php_version
			) );
		}

	}

}

<?php
/**
 * WP Checker class
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
 * WP Checker class
 */
class WP extends Abstracts\Checker {

	/**
	 * Checker name
	 *
	 * @var string
	 */
	protected $name = 'wp';

	/**
	 * Checks if the requirement is met
	 *
	 * @since  1.0.0
	 * @throws \Exception When provided value is not a string or numeric.
	 * @param  mixed $value Value to check against.
	 * @return void
	 */
	public function check( $value ) {

		if ( ! is_string( $value ) && ! is_numeric( $value ) ) {
			throw new \Exception( 'WP Check requires numeric or string parameter' );
		}

		$wp_version = get_bloginfo( 'version' );

		if ( version_compare( $wp_version, $value, '<' ) ) {
			$this->add_error( sprintf(
				// Translators: 1. Required WP version, 2. Current WP version.
				__( 'Minimum required version of WordPress is %1$s. Your version is %2$s', Requirements::$textdomain ),
				$value,
				$wp_version
			) );
		}

	}

}

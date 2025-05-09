<?php
/**
 * DocHooks Checker class
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
 * DocHooks Checker class
 */
class DocHooks extends Abstracts\Checker {

	/**
	 * Checker name
	 *
	 * @var string
	 */
	protected $name = 'dochooks';

	/**
	 * Checks if the requirement is met
	 *
	 * @dochooks-test
	 *
	 * @since  1.0.0
	 * @throws \Exception When provided value is not a string or numeric.
	 * @param  mixed $enabled If dochooks should be enabled or disabled.
	 * @return void
	 */
	public function check( $enabled ) {

		if ( ! is_bool( $enabled ) ) {
			throw new \Exception( 'DocHooks Check requires bool parameter' );
		}

		$reflector   = new \ReflectionClass( $this );
		$has_comment = false !== strpos( $reflector->getMethod( 'check' )->getDocComment(), '@dochooks-test' );

		if ( ! $has_comment && $enabled ) {
			$this->add_error( __( 'Support for DocHooks is required. You need to disable OPCache comment stripping.', Requirements::$textdomain ) );
		}

		if ( $has_comment && ! $enabled ) {
			$this->add_error( __( 'Support for DocHooks is superfluous', Requirements::$textdomain ) );
		}

	}

}

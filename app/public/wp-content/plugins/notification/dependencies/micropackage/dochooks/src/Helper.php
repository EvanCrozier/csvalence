<?php
/**
 * Helper for DocHooks
 *
 * @package micropackage/dochooks
 *
 * @license GPL-3.0-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\Dependencies\Micropackage\DocHooks;

use BracketSpace\Notification\Dependencies\Micropackage\DocHooks\Helper\AnnotationTest;

/**
 * Helper class
 */
class Helper {

	/**
	 * Checks if DocHooks are working
	 *
	 * @since  1.0.0
	 * @return bool
	 */
	public static function is_enabled() {

		$reflector = new \ReflectionObject( new AnnotationTest() );

		foreach ( $reflector->getMethods() as $method ) {
			$doc = $method->getDocComment();
			return (bool) strpos( $doc, '@action' );
		}

	}

	/**
	 * Hooks object methods.
	 *
	 * @since  1.0.0
	 * @param  mixed $object The class object or null.
	 * @return mixed         Subject object.
	 */
	public static function hook( $object ) {
		$dochooks = new HookAnnotations();
		return $dochooks->add_hooks( $object );
	}

}

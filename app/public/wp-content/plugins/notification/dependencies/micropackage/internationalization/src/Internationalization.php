<?php
/**
 * Internationalization class
 *
 * @package micropackage/internationalization
 *
 * @license GPL-3.0-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\Dependencies\Micropackage\Internationalization;

/**
 * Internationalization class
 */
class Internationalization {

	/**
	 * Textdomain
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $textdomain;

	/**
	 * Full path to language files directory
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	protected $lang_dir;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @param string $textdomain         Textdomain.
	 * @param string $full_lang_dir_path Full path to language files directory.
	 */
	public function __construct( $textdomain, $full_lang_dir_path ) {
		$this->textdomain = $textdomain;
		$this->lang_dir   = trailingslashit( $full_lang_dir_path );
	}

	/**
	 * Loads the translation
	 * The file has to be named: {textdomain}-{locale_LOCALE}.mo
	 *
	 * @action init
	 *
	 * @since  1.0.0
	 * @return bool Whether the translation has been loaded or not.
	 */
	public function load_translation() {
		$mo_file = sprintf( '%s%s-%s.mo', $this->lang_dir, $this->textdomain, determine_locale() );
		return load_textdomain( $this->textdomain, $mo_file );
	}

}

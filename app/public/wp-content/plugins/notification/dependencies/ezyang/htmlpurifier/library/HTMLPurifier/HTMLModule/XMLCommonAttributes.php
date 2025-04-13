<?php
/**
 * @license LGPL-2.1-or-later
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

class BracketSpace_Notification_Dependencies_HTMLPurifier_HTMLModule_XMLCommonAttributes extends BracketSpace_Notification_Dependencies_HTMLPurifier_HTMLModule
{
    /**
     * @type string
     */
    public $name = 'XMLCommonAttributes';

    /**
     * @type array
     */
    public $attr_collections = array(
        'Lang' => array(
            'xml:lang' => 'LanguageCode',
        )
    );
}

// vim: et sw=4 sts=4

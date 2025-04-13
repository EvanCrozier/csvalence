<?php
/**
 * @license LGPL-2.1-or-later
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

class BracketSpace_Notification_Dependencies_HTMLPurifier_URIFilter_DisableResources extends BracketSpace_Notification_Dependencies_HTMLPurifier_URIFilter
{
    /**
     * @type string
     */
    public $name = 'DisableResources';

    /**
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_URI $uri
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Context $context
     * @return bool
     */
    public function filter(&$uri, $config, $context)
    {
        return !$context->get('EmbeddedURI', true);
    }
}

// vim: et sw=4 sts=4

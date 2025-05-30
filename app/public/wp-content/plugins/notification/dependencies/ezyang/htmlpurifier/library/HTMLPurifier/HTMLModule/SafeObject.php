<?php

/**
 * A "safe" object module. In theory, objects permitted by this module will
 * be safe, and untrusted users can be allowed to embed arbitrary flash objects
 * (maybe other types too, but only Flash is supported as of right now).
 * Highly experimental.
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */
class BracketSpace_Notification_Dependencies_HTMLPurifier_HTMLModule_SafeObject extends BracketSpace_Notification_Dependencies_HTMLPurifier_HTMLModule
{
    /**
     * @type string
     */
    public $name = 'SafeObject';

    /**
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     */
    public function setup($config)
    {
        // These definitions are not intrinsically safe: the attribute transforms
        // are a vital part of ensuring safety.

        $max = $config->get('HTML.MaxImgLength');
        $object = $this->addElement(
            'object',
            'Inline',
            'Optional: param | Flow | #PCDATA',
            'Common',
            array(
                // While technically not required by the spec, we're forcing
                // it to this value.
                'type' => 'Enum#application/x-shockwave-flash',
                'width' => 'Pixels#' . $max,
                'height' => 'Pixels#' . $max,
                'data' => 'URI#embedded',
                'codebase' => new BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef_Enum(
                    array(
                        'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0'
                    )
                ),
            )
        );
        $object->attr_transform_post[] = new BracketSpace_Notification_Dependencies_HTMLPurifier_AttrTransform_SafeObject();

        $param = $this->addElement(
            'param',
            false,
            'Empty',
            false,
            array(
                'id' => 'ID',
                'name*' => 'Text',
                'value' => 'Text'
            )
        );
        $param->attr_transform_post[] = new BracketSpace_Notification_Dependencies_HTMLPurifier_AttrTransform_SafeParam();
        $this->info_injector[] = 'SafeObject';
    }
}

// vim: et sw=4 sts=4

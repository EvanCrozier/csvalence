<?php

/**
 * Validates shorthand CSS property background.
 * @warning Does not support url tokens that have internal spaces.
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */
class BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef_CSS_Background extends BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef
{

    /**
     * Local copy of component validators.
     * @type BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef[]
     * @note See HTMLPurifier_AttrDef_Font::$info for a similar impl.
     */
    protected $info;

    /**
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     */
    public function __construct($config)
    {
        $def = $config->getCSSDefinition();
        $this->info['background-color'] = $def->info['background-color'];
        $this->info['background-image'] = $def->info['background-image'];
        $this->info['background-repeat'] = $def->info['background-repeat'];
        $this->info['background-attachment'] = $def->info['background-attachment'];
        $this->info['background-position'] = $def->info['background-position'];
        $this->info['background-size'] = $def->info['background-size'];
    }

    /**
     * @param string $string
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Context $context
     * @return bool|string
     */
    public function validate($string, $config, $context)
    {
        // regular pre-processing
        $string = $this->parseCDATA($string);
        if ($string === '') {
            return false;
        }

        // munge rgb() decl if necessary
        $string = $this->mungeRgb($string);

        // assumes URI doesn't have spaces in it
        $bits = explode(' ', $string); // bits to process

        $caught = array();
        $caught['color'] = false;
        $caught['image'] = false;
        $caught['repeat'] = false;
        $caught['attachment'] = false;
        $caught['position'] = false;
        $caught['size'] = false;

        $i = 0; // number of catches

        foreach ($bits as $bit) {
            if ($bit === '') {
                continue;
            }
            foreach ($caught as $key => $status) {
                if ($key != 'position') {
                    if ($status !== false) {
                        continue;
                    }
                    $r = $this->info['background-' . $key]->validate($bit, $config, $context);
                } else {
                    $r = $bit;
                }
                if ($r === false) {
                    continue;
                }
                if ($key == 'position') {
                    if ($caught[$key] === false) {
                        $caught[$key] = '';
                    }
                    $caught[$key] .= $r . ' ';
                } else {
                    $caught[$key] = $r;
                }
                $i++;
                break;
            }
        }

        if (!$i) {
            return false;
        }
        if ($caught['position'] !== false) {
            $caught['position'] = $this->info['background-position']->
                validate($caught['position'], $config, $context);
        }

        $ret = array();
        foreach ($caught as $value) {
            if ($value === false) {
                continue;
            }
            $ret[] = $value;
        }

        if (empty($ret)) {
            return false;
        }
        return implode(' ', $ret);
    }
}

// vim: et sw=4 sts=4

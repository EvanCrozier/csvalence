<?php

/**
 * Validates an integer.
 * @note While this class was modeled off the CSS definition, no currently
 *       allowed CSS uses this type.  The properties that do are: widows,
 *       orphans, z-index, counter-increment, counter-reset.  Some of the
 *       HTML attributes, however, find use for a non-negative version of this.
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */
class BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef_Integer extends BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef
{

    /**
     * Whether or not negative values are allowed.
     * @type bool
     */
    protected $negative = true;

    /**
     * Whether or not zero is allowed.
     * @type bool
     */
    protected $zero = true;

    /**
     * Whether or not positive values are allowed.
     * @type bool
     */
    protected $positive = true;

    /**
     * @param $negative Bool indicating whether or not negative values are allowed
     * @param $zero Bool indicating whether or not zero is allowed
     * @param $positive Bool indicating whether or not positive values are allowed
     */
    public function __construct($negative = true, $zero = true, $positive = true)
    {
        $this->negative = $negative;
        $this->zero = $zero;
        $this->positive = $positive;
    }

    /**
     * @param string $integer
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Context $context
     * @return bool|string
     */
    public function validate($integer, $config, $context)
    {
        $integer = $this->parseCDATA($integer);
        if ($integer === '') {
            return false;
        }

        // we could possibly simply typecast it to integer, but there are
        // certain fringe cases that must not return an integer.

        // clip leading sign
        if ($this->negative && $integer[0] === '-') {
            $digits = substr($integer, 1);
            if ($digits === '0') {
                $integer = '0';
            } // rm minus sign for zero
        } elseif ($this->positive && $integer[0] === '+') {
            $digits = $integer = substr($integer, 1); // rm unnecessary plus
        } else {
            $digits = $integer;
        }

        // test if it's numeric
        if (!ctype_digit($digits)) {
            return false;
        }

        // perform scope tests
        if (!$this->zero && $integer == 0) {
            return false;
        }
        if (!$this->positive && $integer > 0) {
            return false;
        }
        if (!$this->negative && $integer < 0) {
            return false;
        }

        return $integer;
    }
}

// vim: et sw=4 sts=4

<?php

/**
 * Validates an IPv4 address
 * @author Feyd @ forums.devnetwork.net (public domain)
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */
class BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef_URI_IPv4 extends BracketSpace_Notification_Dependencies_HTMLPurifier_AttrDef
{

    /**
     * IPv4 regex, protected so that IPv6 can reuse it.
     * @type string
     */
    protected $ip4;

    /**
     * @param string $aIP
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Context $context
     * @return bool|string
     */
    public function validate($aIP, $config, $context)
    {
        if (!$this->ip4) {
            $this->_loadRegex();
        }

        if (preg_match('#^' . $this->ip4 . '$#s', $aIP)) {
            return $aIP;
        }
        return false;
    }

    /**
     * Lazy load function to prevent regex from being stuffed in
     * cache.
     */
    protected function _loadRegex()
    {
        $oct = '(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]|[0-9])'; // 0-255
        $this->ip4 = "(?:{$oct}\\.{$oct}\\.{$oct}\\.{$oct})";
    }
}

// vim: et sw=4 sts=4

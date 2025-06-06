<?php

/**
 * @file
 * Legacy autoloader for systems lacking spl_autoload_register
 *
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

spl_autoload_register(function($class)
{
     return BracketSpace_Notification_Dependencies_HTMLPurifier_Bootstrap::autoload($class);
});

// vim: et sw=4 sts=4

<?php

/**
 * Core strategy composed of the big four strategies.
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */
class BracketSpace_Notification_Dependencies_HTMLPurifier_Strategy_Core extends BracketSpace_Notification_Dependencies_HTMLPurifier_Strategy_Composite
{
    public function __construct()
    {
        $this->strategies[] = new BracketSpace_Notification_Dependencies_HTMLPurifier_Strategy_RemoveForeignElements();
        $this->strategies[] = new BracketSpace_Notification_Dependencies_HTMLPurifier_Strategy_MakeWellFormed();
        $this->strategies[] = new BracketSpace_Notification_Dependencies_HTMLPurifier_Strategy_FixNesting();
        $this->strategies[] = new BracketSpace_Notification_Dependencies_HTMLPurifier_Strategy_ValidateAttributes();
    }
}

// vim: et sw=4 sts=4

<?php

/**
 * Takes the contents of blockquote when in strict and reformats for validation.
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */
class BracketSpace_Notification_Dependencies_HTMLPurifier_ChildDef_StrictBlockquote extends BracketSpace_Notification_Dependencies_HTMLPurifier_ChildDef_Required
{
    /**
     * @type array
     */
    protected $real_elements;

    /**
     * @type array
     */
    protected $fake_elements;

    /**
     * @type bool
     */
    public $allow_empty = true;

    /**
     * @type string
     */
    public $type = 'strictblockquote';

    /**
     * @type bool
     */
    protected $init = false;

    /**
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     * @return array
     * @note We don't want MakeWellFormed to auto-close inline elements since
     *       they might be allowed.
     */
    public function getAllowedElements($config)
    {
        $this->init($config);
        return $this->fake_elements;
    }

    /**
     * @param array $children
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Context $context
     * @return array
     */
    public function validateChildren($children, $config, $context)
    {
        $this->init($config);

        // trick the parent class into thinking it allows more
        $this->elements = $this->fake_elements;
        $result = parent::validateChildren($children, $config, $context);
        $this->elements = $this->real_elements;

        if ($result === false) {
            return array();
        }
        if ($result === true) {
            $result = $children;
        }

        $def = $config->getHTMLDefinition();
        $block_wrap_name = $def->info_block_wrapper;
        $block_wrap = false;
        $ret = array();

        foreach ($result as $node) {
            if ($block_wrap === false) {
                if (($node instanceof BracketSpace_Notification_Dependencies_HTMLPurifier_Node_Text && !$node->is_whitespace) ||
                    ($node instanceof BracketSpace_Notification_Dependencies_HTMLPurifier_Node_Element && !isset($this->elements[$node->name]))) {
                        $block_wrap = new BracketSpace_Notification_Dependencies_HTMLPurifier_Node_Element($def->info_block_wrapper);
                        $ret[] = $block_wrap;
                }
            } else {
                if ($node instanceof BracketSpace_Notification_Dependencies_HTMLPurifier_Node_Element && isset($this->elements[$node->name])) {
                    $block_wrap = false;

                }
            }
            if ($block_wrap) {
                $block_wrap->children[] = $node;
            } else {
                $ret[] = $node;
            }
        }
        return $ret;
    }

    /**
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     */
    private function init($config)
    {
        if (!$this->init) {
            $def = $config->getHTMLDefinition();
            // allow all inline elements
            $this->real_elements = $this->elements;
            $this->fake_elements = $def->info_content_sets['Flow'];
            $this->fake_elements['#PCDATA'] = true;
            $this->init = true;
        }
    }
}

// vim: et sw=4 sts=4

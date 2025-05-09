<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node;

use BracketSpace\Notification\Dependencies\PhpParser\NodeAbstract;

class ClosureUse extends NodeAbstract {
    /** @var Expr\Variable Variable to use */
    public Expr\Variable $var;
    /** @var bool Whether to use by reference */
    public bool $byRef;

    /**
     * Constructs a closure use node.
     *
     * @param Expr\Variable $var Variable to use
     * @param bool $byRef Whether to use by reference
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Expr\Variable $var, bool $byRef = false, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->byRef = $byRef;
    }

    public function getSubNodeNames(): array {
        return ['var', 'byRef'];
    }

    public function getType(): string {
        return 'ClosureUse';
    }
}

// @deprecated compatibility alias
class_alias(ClosureUse::class, Expr\ClosureUse::class);

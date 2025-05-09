<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node\Stmt\TraitUseAdaptation;

use BracketSpace\Notification\Dependencies\PhpParser\Node;

class Precedence extends Node\Stmt\TraitUseAdaptation {
    /** @var Node\Name[] Overwritten traits */
    public array $insteadof;

    /**
     * Constructs a trait use precedence adaptation node.
     *
     * @param Node\Name $trait Trait name
     * @param string|Node\Identifier $method Method name
     * @param Node\Name[] $insteadof Overwritten traits
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Node\Name $trait, $method, array $insteadof, array $attributes = []) {
        $this->attributes = $attributes;
        $this->trait = $trait;
        $this->method = \is_string($method) ? new Node\Identifier($method) : $method;
        $this->insteadof = $insteadof;
    }

    public function getSubNodeNames(): array {
        return ['trait', 'method', 'insteadof'];
    }

    public function getType(): string {
        return 'Stmt_TraitUseAdaptation_Precedence';
    }
}

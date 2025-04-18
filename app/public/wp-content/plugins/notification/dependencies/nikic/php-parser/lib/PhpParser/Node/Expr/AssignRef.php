<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node\Expr;

use BracketSpace\Notification\Dependencies\PhpParser\Node\Expr;

class AssignRef extends Expr {
    /** @var Expr Variable reference is assigned to */
    public Expr $var;
    /** @var Expr Variable which is referenced */
    public Expr $expr;

    /**
     * Constructs an assignment node.
     *
     * @param Expr $var Variable
     * @param Expr $expr Expression
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Expr $var, Expr $expr, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->expr = $expr;
    }

    public function getSubNodeNames(): array {
        return ['var', 'expr'];
    }

    public function getType(): string {
        return 'Expr_AssignRef';
    }
}

<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node;

use BracketSpace\Notification\Dependencies\PhpParser\Node;
use BracketSpace\Notification\Dependencies\PhpParser\NodeAbstract;

class StaticVar extends NodeAbstract {
    /** @var Expr\Variable Variable */
    public Expr\Variable $var;
    /** @var null|Node\Expr Default value */
    public ?Expr $default;

    /**
     * Constructs a static variable node.
     *
     * @param Expr\Variable $var Name
     * @param null|Node\Expr $default Default value
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(
        Expr\Variable $var, ?Node\Expr $default = null, array $attributes = []
    ) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->default = $default;
    }

    public function getSubNodeNames(): array {
        return ['var', 'default'];
    }

    public function getType(): string {
        return 'StaticVar';
    }
}

// @deprecated compatibility alias
class_alias(StaticVar::class, Stmt\StaticVar::class);

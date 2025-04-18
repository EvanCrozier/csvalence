<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node;

use BracketSpace\Notification\Dependencies\PhpParser\Modifiers;
use BracketSpace\Notification\Dependencies\PhpParser\Node;
use BracketSpace\Notification\Dependencies\PhpParser\NodeAbstract;

class Param extends NodeAbstract {
    /** @var null|Identifier|Name|ComplexType Type declaration */
    public ?Node $type;
    /** @var bool Whether parameter is passed by reference */
    public bool $byRef;
    /** @var bool Whether this is a variadic argument */
    public bool $variadic;
    /** @var Expr\Variable|Expr\Error Parameter variable */
    public Expr $var;
    /** @var null|Expr Default value */
    public ?Expr $default;
    /** @var int Optional visibility flags */
    public int $flags;
    /** @var AttributeGroup[] PHP attribute groups */
    public array $attrGroups;
    /** @var PropertyHook[] Property hooks for promoted properties */
    public array $hooks;

    /**
     * Constructs a parameter node.
     *
     * @param Expr\Variable|Expr\Error $var Parameter variable
     * @param null|Expr $default Default value
     * @param null|Identifier|Name|ComplexType $type Type declaration
     * @param bool $byRef Whether is passed by reference
     * @param bool $variadic Whether this is a variadic argument
     * @param array<string, mixed> $attributes Additional attributes
     * @param int $flags Optional visibility flags
     * @param list<AttributeGroup> $attrGroups PHP attribute groups
     * @param PropertyHook[] $hooks Property hooks for promoted properties
     */
    public function __construct(
        Expr $var, ?Expr $default = null, ?Node $type = null,
        bool $byRef = false, bool $variadic = false,
        array $attributes = [],
        int $flags = 0,
        array $attrGroups = [],
        array $hooks = []
    ) {
        $this->attributes = $attributes;
        $this->type = $type;
        $this->byRef = $byRef;
        $this->variadic = $variadic;
        $this->var = $var;
        $this->default = $default;
        $this->flags = $flags;
        $this->attrGroups = $attrGroups;
        $this->hooks = $hooks;
    }

    public function getSubNodeNames(): array {
        return ['attrGroups', 'flags', 'type', 'byRef', 'variadic', 'var', 'default', 'hooks'];
    }

    public function getType(): string {
        return 'Param';
    }

    /**
     * Whether this parameter uses constructor property promotion.
     */
    public function isPromoted(): bool {
        return $this->flags !== 0;
    }

    public function isPublic(): bool {
        return (bool) ($this->flags & Modifiers::PUBLIC);
    }

    public function isProtected(): bool {
        return (bool) ($this->flags & Modifiers::PROTECTED);
    }

    public function isPrivate(): bool {
        return (bool) ($this->flags & Modifiers::PRIVATE);
    }

    public function isReadonly(): bool {
        return (bool) ($this->flags & Modifiers::READONLY);
    }

    /**
     * Whether the promoted property has explicit public(set) visibility.
     */
    public function isPublicSet(): bool {
        return (bool) ($this->flags & Modifiers::PUBLIC_SET);
    }

    /**
     * Whether the promoted property has explicit protected(set) visibility.
     */
    public function isProtectedSet(): bool {
        return (bool) ($this->flags & Modifiers::PROTECTED_SET);
    }

    /**
     * Whether the promoted property has explicit private(set) visibility.
     */
    public function isPrivateSet(): bool {
        return (bool) ($this->flags & Modifiers::PRIVATE_SET);
    }
}

<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node\Stmt;

use BracketSpace\Notification\Dependencies\PhpParser\Node;

class Foreach_ extends Node\Stmt {
    /** @var Node\Expr Expression to iterate */
    public Node\Expr $expr;
    /** @var null|Node\Expr Variable to assign key to */
    public ?Node\Expr $keyVar;
    /** @var bool Whether to assign value by reference */
    public bool $byRef;
    /** @var Node\Expr Variable to assign value to */
    public Node\Expr $valueVar;
    /** @var Node\Stmt[] Statements */
    public array $stmts;

    /**
     * Constructs a foreach node.
     *
     * @param Node\Expr $expr Expression to iterate
     * @param Node\Expr $valueVar Variable to assign value to
     * @param array{
     *     keyVar?: Node\Expr|null,
     *     byRef?: bool,
     *     stmts?: Node\Stmt[],
     * } $subNodes Array of the following optional subnodes:
     *             'keyVar' => null   : Variable to assign key to
     *             'byRef'  => false  : Whether to assign value by reference
     *             'stmts'  => array(): Statements
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Node\Expr $expr, Node\Expr $valueVar, array $subNodes = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->expr = $expr;
        $this->keyVar = $subNodes['keyVar'] ?? null;
        $this->byRef = $subNodes['byRef'] ?? false;
        $this->valueVar = $valueVar;
        $this->stmts = $subNodes['stmts'] ?? [];
    }

    public function getSubNodeNames(): array {
        return ['expr', 'keyVar', 'byRef', 'valueVar', 'stmts'];
    }

    public function getType(): string {
        return 'Stmt_Foreach';
    }
}

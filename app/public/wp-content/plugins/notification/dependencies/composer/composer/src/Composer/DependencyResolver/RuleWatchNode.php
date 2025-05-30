<?php
/**
 * @license MIT
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BracketSpace\Notification\Dependencies\Composer\DependencyResolver;

/**
 * Wrapper around a Rule which keeps track of the two literals it watches
 *
 * Used by RuleWatchGraph to store rules in two RuleWatchChains.
 *
 * @author Nils Adermann <naderman@naderman.de>
 */
class RuleWatchNode
{
    /** @var int */
    public $watch1;
    /** @var int */
    public $watch2;

    /** @var Rule */
    protected $rule;

    /**
     * Creates a new node watching the first and second literals of the rule.
     *
     * @param Rule $rule The rule to wrap
     */
    public function __construct(Rule $rule)
    {
        $this->rule = $rule;

        $literals = $rule->getLiterals();

        $literalCount = \count($literals);
        $this->watch1 = $literalCount > 0 ? $literals[0] : 0;
        $this->watch2 = $literalCount > 1 ? $literals[1] : 0;
    }

    /**
     * Places the second watch on the rule's literal, decided at the highest level
     *
     * Useful for learned rules where the literal for the highest rule is most
     * likely to quickly lead to further decisions.
     *
     * @param Decisions $decisions The decisions made so far by the solver
     */
    public function watch2OnHighest(Decisions $decisions): void
    {
        $literals = $this->rule->getLiterals();

        // if there are only 2 elements, both are being watched anyway
        if (\count($literals) < 3 || $this->rule instanceof MultiConflictRule) {
            return;
        }

        $watchLevel = 0;

        foreach ($literals as $literal) {
            $level = $decisions->decisionLevel($literal);

            if ($level > $watchLevel) {
                $this->watch2 = $literal;
                $watchLevel = $level;
            }
        }
    }

    /**
     * Returns the rule this node wraps
     */
    public function getRule(): Rule
    {
        return $this->rule;
    }

    /**
     * Given one watched literal, this method returns the other watched literal
     *
     * @param  int $literal The watched literal that should not be returned
     * @return int A literal
     */
    public function getOtherWatch(int $literal): int
    {
        if ($this->watch1 === $literal) {
            return $this->watch2;
        }

        return $this->watch1;
    }

    /**
     * Moves a watch from one literal to another
     *
     * @param int $from The previously watched literal
     * @param int $to   The literal to be watched now
     */
    public function moveWatch(int $from, int $to): void
    {
        if ($this->watch1 === $from) {
            $this->watch1 = $to;
        } else {
            $this->watch2 = $to;
        }
    }
}

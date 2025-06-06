<?php

/*
 * This file is part of the JSON Lint package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\Dependencies\Seld\JsonLint;

class ParsingException extends \Exception
{
    /**
     * @var array{text?: string, token?: string|int, line?: int, loc?: array{first_line: int, first_column: int, last_line: int, last_column: int}, expected?: string[]}
     */
    protected $details;

    /**
     * @param string $message
     * @phpstan-param array{text?: string, token?: string|int, line?: int, loc?: array{first_line: int, first_column: int, last_line: int, last_column: int}, expected?: string[]} $details
     */
    public function __construct($message, $details = array())
    {
        $this->details = $details;
        parent::__construct($message);
    }

    /**
     * @phpstan-return array{text?: string, token?: string|int, line?: int, loc?: array{first_line: int, first_column: int, last_line: int, last_column: int}, expected?: string[]}
     */
    public function getDetails()
    {
        return $this->details;
    }
}

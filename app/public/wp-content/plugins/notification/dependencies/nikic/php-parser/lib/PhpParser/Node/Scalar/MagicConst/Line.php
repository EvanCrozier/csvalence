<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node\Scalar\MagicConst;

use BracketSpace\Notification\Dependencies\PhpParser\Node\Scalar\MagicConst;

class Line extends MagicConst {
    public function getName(): string {
        return '__LINE__';
    }

    public function getType(): string {
        return 'Scalar_MagicConst_Line';
    }
}

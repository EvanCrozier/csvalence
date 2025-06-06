<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\Node\Expr\Cast;

use BracketSpace\Notification\Dependencies\PhpParser\Node\Expr\Cast;

class Array_ extends Cast {
    public function getType(): string {
        return 'Expr_Cast_Array';
    }
}

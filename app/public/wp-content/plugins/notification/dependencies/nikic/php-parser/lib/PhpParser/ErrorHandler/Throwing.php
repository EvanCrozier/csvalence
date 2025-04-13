<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\PhpParser\ErrorHandler;

use BracketSpace\Notification\Dependencies\PhpParser\Error;
use BracketSpace\Notification\Dependencies\PhpParser\ErrorHandler;

/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements ErrorHandler {
    public function handleError(Error $error): void {
        throw $error;
    }
}

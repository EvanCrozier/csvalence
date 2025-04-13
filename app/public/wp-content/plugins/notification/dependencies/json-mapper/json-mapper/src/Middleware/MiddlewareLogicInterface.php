<?php
/**
 * @license MIT
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\JsonMapper\Middleware;

use BracketSpace\Notification\Dependencies\JsonMapper\JsonMapperInterface;
use BracketSpace\Notification\Dependencies\JsonMapper\ValueObjects\PropertyMap;
use BracketSpace\Notification\Dependencies\JsonMapper\Wrapper\ObjectWrapper;
use stdClass;

interface MiddlewareLogicInterface
{
    public function handle(
        stdClass $json,
        ObjectWrapper $object,
        PropertyMap $propertyMap,
        JsonMapperInterface $mapper
    ): void;
}

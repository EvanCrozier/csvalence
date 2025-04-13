<?php
/**
 * @license MIT
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\League\Flysystem;

use RuntimeException;

class UnableToResolveFilesystemMount extends RuntimeException implements FilesystemException
{
    public static function becauseTheSeparatorIsMissing(string $path): UnableToResolveFilesystemMount
    {
        return new UnableToResolveFilesystemMount("Unable to resolve the filesystem mount because the path ($path) is missing a separator (://).");
    }

    public static function becauseTheMountWasNotRegistered(string $mountIdentifier): UnableToResolveFilesystemMount
    {
        return new UnableToResolveFilesystemMount("Unable to resolve the filesystem mount because the mount ($mountIdentifier) was not registered.");
    }
}

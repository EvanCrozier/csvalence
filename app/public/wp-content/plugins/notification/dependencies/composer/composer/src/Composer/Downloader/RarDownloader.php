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

namespace BracketSpace\Notification\Dependencies\Composer\Downloader;

use BracketSpace\Notification\Dependencies\React\Promise\PromiseInterface;
use BracketSpace\Notification\Dependencies\Composer\Util\IniHelper;
use BracketSpace\Notification\Dependencies\Composer\Util\Platform;
use BracketSpace\Notification\Dependencies\Composer\Util\ProcessExecutor;
use BracketSpace\Notification\Dependencies\Composer\Package\PackageInterface;
use RarArchive;

/**
 * RAR archive downloader.
 *
 * Based on previous work by Jordi Boggiano ({@see ZipDownloader}).
 *
 * @author Derrick Nelson <drrcknlsn@gmail.com>
 */
class RarDownloader extends ArchiveDownloader
{
    protected function extract(PackageInterface $package, string $file, string $path): PromiseInterface
    {
        $processError = null;

        // Try to use unrar on *nix
        if (!Platform::isWindows()) {
            $command = 'unrar x -- ' . ProcessExecutor::escape($file) . ' ' . ProcessExecutor::escape($path) . ' >/dev/null && chmod -R u+w ' . ProcessExecutor::escape($path);

            if (0 === $this->process->execute($command, $ignoredOutput)) {
                return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
            }

            $processError = 'Failed to execute ' . $command . "\n\n" . $this->process->getErrorOutput();
        }

        if (!class_exists('RarArchive')) {
            // php.ini path is added to the error message to help users find the correct file
            $iniMessage = IniHelper::getMessage();

            $error = "Could not decompress the archive, enable the PHP rar extension or install unrar.\n"
                . $iniMessage . "\n" . $processError;

            if (!Platform::isWindows()) {
                $error = "Could not decompress the archive, enable the PHP rar extension.\n" . $iniMessage;
            }

            throw new \RuntimeException($error);
        }

        $rarArchive = RarArchive::open($file);

        if (false === $rarArchive) {
            throw new \UnexpectedValueException('Could not open RAR archive: ' . $file);
        }

        $entries = $rarArchive->getEntries();

        if (false === $entries) {
            throw new \RuntimeException('Could not retrieve RAR archive entries');
        }

        foreach ($entries as $entry) {
            if (false === $entry->extract($path)) {
                throw new \RuntimeException('Could not extract entry');
            }
        }

        $rarArchive->close();

        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }
}

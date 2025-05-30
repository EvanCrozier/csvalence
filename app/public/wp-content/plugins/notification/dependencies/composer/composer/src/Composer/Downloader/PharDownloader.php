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
use BracketSpace\Notification\Dependencies\Composer\Package\PackageInterface;

/**
 * Downloader for phar files
 *
 * @author Kirill chEbba Chebunin <iam@chebba.org>
 */
class PharDownloader extends ArchiveDownloader
{
    /**
     * @inheritDoc
     */
    protected function extract(PackageInterface $package, string $file, string $path): PromiseInterface
    {
        // Can throw an UnexpectedValueException
        $archive = new \Phar($file);
        $archive->extractTo($path, null, true);
        /* TODO: handle openssl signed phars
         * https://github.com/composer/composer/pull/33#issuecomment-2250768
         * https://github.com/koto/phar-util
         * http://blog.kotowicz.net/2010/08/hardening-php-how-to-securely-include.html
         */

        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }
}

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

namespace BracketSpace\Notification\Dependencies\Composer\Package\Archiver;

use FilterIterator;
use Iterator;
use PharData;
use SplFileInfo;

/**
 * @phpstan-extends FilterIterator<string, SplFileInfo, Iterator<string, SplFileInfo>>
 */
class ArchivableFilesFilter extends FilterIterator
{
    /** @var string[] */
    private $dirs = [];

    /**
     * @return bool true if the current element is acceptable, otherwise false.
     */
    public function accept(): bool
    {
        $file = $this->getInnerIterator()->current();
        if ($file->isDir()) {
            $this->dirs[] = (string) $file;

            return false;
        }

        return true;
    }

    public function addEmptyDir(PharData $phar, string $sources): void
    {
        foreach ($this->dirs as $filepath) {
            $localname = str_replace($sources . "/", '', $filepath);
            $phar->addEmptyDir($localname);
        }
    }
}

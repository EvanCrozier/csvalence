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

namespace BracketSpace\Notification\Dependencies\Composer\Advisory;

use BracketSpace\Notification\Dependencies\Composer\Semver\Constraint\ConstraintInterface;
use DateTimeImmutable;

class IgnoredSecurityAdvisory extends SecurityAdvisory
{
    /**
     * @var string|null
     * @readonly
     */
    public $ignoreReason;

    /**
     * @param non-empty-array<array{name: string, remoteId: string}> $sources
     */
    public function __construct(string $packageName, string $advisoryId, ConstraintInterface $affectedVersions, string $title, array $sources, DateTimeImmutable $reportedAt, ?string $cve = null, ?string $link = null, ?string $ignoreReason = null, ?string $severity = null)
    {
        parent::__construct($packageName, $advisoryId, $affectedVersions, $title, $sources, $reportedAt, $cve, $link, $severity);

        $this->ignoreReason = $ignoreReason;
    }

    /**
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        if ($this->ignoreReason === NULL) {
            unset($data['ignoreReason']);
        }

        return $data;
    }

}

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

namespace BracketSpace\Notification\Dependencies\Composer\DependencyResolver\Operation;

use BracketSpace\Notification\Dependencies\Composer\Package\AliasPackage;

/**
 * Solver install operation.
 *
 * @author Nils Adermann <naderman@naderman.de>
 */
class MarkAliasUninstalledOperation extends SolverOperation implements OperationInterface
{
    protected const TYPE = 'markAliasUninstalled';

    /**
     * @var AliasPackage
     */
    protected $package;

    public function __construct(AliasPackage $package)
    {
        $this->package = $package;
    }

    /**
     * Returns package instance.
     */
    public function getPackage(): AliasPackage
    {
        return $this->package;
    }

    /**
     * @inheritDoc
     */
    public function show($lock): string
    {
        return 'Marking <info>'.$this->package->getPrettyName().'</info> (<comment>'.$this->package->getFullPrettyVersion().'</comment>) as uninstalled, alias of <info>'.$this->package->getAliasOf()->getPrettyName().'</info> (<comment>'.$this->package->getAliasOf()->getFullPrettyVersion().'</comment>)';
    }
}

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

namespace BracketSpace\Notification\Dependencies\Composer\Installer;

use BracketSpace\Notification\Dependencies\Composer\Repository\InstalledRepositoryInterface;
use BracketSpace\Notification\Dependencies\Composer\Package\PackageInterface;

/**
 * Does not install anything but marks packages installed in the repo
 *
 * Useful for dry runs
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class NoopInstaller implements InstallerInterface
{
    /**
     * @inheritDoc
     */
    public function supports(string $packageType)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isInstalled(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        return $repo->hasPackage($package);
    }

    /**
     * @inheritDoc
     */
    public function download(PackageInterface $package, ?PackageInterface $prevPackage = null)
    {
        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }

    /**
     * @inheritDoc
     */
    public function prepare($type, PackageInterface $package, ?PackageInterface $prevPackage = null)
    {
        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }

    /**
     * @inheritDoc
     */
    public function cleanup($type, PackageInterface $package, ?PackageInterface $prevPackage = null)
    {
        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }

    /**
     * @inheritDoc
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if (!$repo->hasPackage($package)) {
            $repo->addPackage(clone $package);
        }

        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }

    /**
     * @inheritDoc
     */
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        if (!$repo->hasPackage($initial)) {
            throw new \InvalidArgumentException('Package is not installed: '.$initial);
        }

        $repo->removePackage($initial);
        if (!$repo->hasPackage($target)) {
            $repo->addPackage(clone $target);
        }

        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }

    /**
     * @inheritDoc
     */
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if (!$repo->hasPackage($package)) {
            throw new \InvalidArgumentException('Package is not installed: '.$package);
        }
        $repo->removePackage($package);

        return \BracketSpace\Notification\Dependencies\React\Promise\resolve(null);
    }

    /**
     * @inheritDoc
     */
    public function getInstallPath(PackageInterface $package)
    {
        $targetDir = $package->getTargetDir();

        return $package->getPrettyName() . ($targetDir ? '/'.$targetDir : '');
    }
}

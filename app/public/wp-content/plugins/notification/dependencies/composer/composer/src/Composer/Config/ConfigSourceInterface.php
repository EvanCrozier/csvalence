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

namespace BracketSpace\Notification\Dependencies\Composer\Config;

/**
 * Configuration Source Interface
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @author Beau Simensen <beau@dflydev.com>
 */
interface ConfigSourceInterface
{
    /**
     * Add a repository
     *
     * @param string        $name   Name
     * @param mixed[]|false $config Configuration
     * @param bool          $append Whether the repo should be appended (true) or prepended (false)
     */
    public function addRepository(string $name, $config, bool $append = true): void;

    /**
     * Remove a repository
     */
    public function removeRepository(string $name): void;

    /**
     * Add a config setting
     *
     * @param string $name  Name
     * @param mixed  $value Value
     */
    public function addConfigSetting(string $name, $value): void;

    /**
     * Remove a config setting
     */
    public function removeConfigSetting(string $name): void;

    /**
     * Add a property
     *
     * @param string $name  Name
     * @param string|string[] $value Value
     */
    public function addProperty(string $name, $value): void;

    /**
     * Remove a property
     */
    public function removeProperty(string $name): void;

    /**
     * Add a package link
     *
     * @param string $type  Type (require, require-dev, provide, suggest, replace, conflict)
     * @param string $name  Name
     * @param string $value Value
     */
    public function addLink(string $type, string $name, string $value): void;

    /**
     * Remove a package link
     *
     * @param string $type Type (require, require-dev, provide, suggest, replace, conflict)
     * @param string $name Name
     */
    public function removeLink(string $type, string $name): void;

    /**
     * Gives a user-friendly name to this source (file path or so)
     */
    public function getName(): string;
}

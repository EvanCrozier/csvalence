<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\Dependencies\Symfony\Contracts\Service;

use BracketSpace\Notification\Dependencies\Psr\Container\ContainerInterface;

/**
 * A ServiceProviderInterface exposes the identifiers and the types of services provided by a container.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 * @author Mateusz Sip <mateusz.sip@gmail.com>
 */
interface ServiceProviderInterface extends ContainerInterface
{
    /**
     * Returns an associative array of service types keyed by the identifiers provided by the current container.
     *
     * Examples:
     *
     *  * ['logger' => 'BracketSpace\Notification\Dependencies\Psr\Log\LoggerInterface'] means the object provides a service named "logger" that implements BracketSpace\Notification\Dependencies\Psr\Log\LoggerInterface
     *  * ['foo' => '?'] means the container provides service name "foo" of unspecified type
     *  * ['bar' => '?Bar\Baz'] means the container provides a service "bar" of type Bar\Baz|null
     *
     * @return string[] The provided service types, keyed by service names
     */
    public function getProvidedServices(): array;
}

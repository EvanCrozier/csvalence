<?php
/**
 * @license MIT
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace BracketSpace\Notification\Dependencies\JsonMapper\ValueObjects;

/**
 * @psalm-immutable
 */
class PropertyType implements \JsonSerializable
{
    /** @var string */
    private $type;
    /** @var ArrayInformation */
    private $arrayInformation;

    public function __construct(string $type, ArrayInformation $isArray)
    {
        $this->type = $type;
        $this->arrayInformation = $isArray;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isArray(): bool
    {
        return $this->arrayInformation->isArray();
    }

    public function isMultiDimensionalArray(): bool
    {
        return $this->arrayInformation->isMultiDimensionalArray();
    }

    public function getArrayInformation(): ArrayInformation
    {
        return $this->arrayInformation;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
            'isArray' => $this->arrayInformation->isArray(),
            'arrayInformation' => $this->arrayInformation,
        ];
    }
}

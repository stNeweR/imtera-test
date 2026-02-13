<?php

namespace App\DTO;

use InvalidArgumentException;
use JsonSerializable;
use ReflectionClass;
use ReflectionException;
use RuntimeException;

abstract class BaseDTO implements JsonSerializable
{
    abstract protected function getRequiredFields(): array;

    /**
     * @throws ReflectionException
     */
    public static function fromArray(array $data): static
    {
        $reflection = new ReflectionClass(static::class);
        $constructor = $reflection->getConstructor();

        if (! $constructor) {
            throw new RuntimeException('DTO class must have a constructor');
        }

        $parameters = $constructor->getParameters();
        $args = [];

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            if (! array_key_exists($name, $data)) {
                if ($parameter->isDefaultValueAvailable()) {
                    $args[] = $parameter->getDefaultValue();
                } else {
                    throw new InvalidArgumentException("Field {$name} is required");
                }
            } else {
                $args[] = $data[$name];
            }
        }

        return $reflection->newInstanceArgs($args);
    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

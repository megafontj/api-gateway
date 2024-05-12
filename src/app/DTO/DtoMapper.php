<?php

namespace App\DTO;

use ReflectionClass;
use ReflectionProperty;

abstract class DtoMapper
{
    public function __construct(array $data)
    {
        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

        static::mapProperties($properties, $data);
    }

    /**
     * @param ReflectionProperty[] $properties
     * @param $data
     * @return void
     */
    public function mapProperties(array $properties, $data): void
    {
        foreach ($properties as $property) {
            if (array_key_exists($property->getName(), $data)) {
                $this->{$property->getName()} = $data[$property->getName()];
            }
        }
    }
}

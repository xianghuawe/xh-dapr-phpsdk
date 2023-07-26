<?php

namespace Dapr\Deserialization\Attributes;

/**
 * Class ArrayOf
 *
 * Indicates that a value is an array of a specific type
 *
 * @package Dapr\Deserialization\Attributes
 */
final class ArrayOf
{
    public function __construct(string $type)
    {
    }
}

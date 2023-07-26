<?php

namespace Dapr\Client;

/**
 * Class BindingRequest
 * @package Dapr\Client
 */
class BindingRequest
{
    public function __construct(
        string $bindingName,
        string $operation,
               $data = null,
        array  $metadata = []
    )
    {
    }
}

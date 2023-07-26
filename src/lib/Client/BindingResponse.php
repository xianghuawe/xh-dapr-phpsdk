<?php

namespace Dapr\Client;

/**
 * Class BindingResponse
 * @package Dapr\Client
 * @template T
 */
class BindingResponse
{
    /**
     * BindingResponse constructor.
     * @param BindingRequest $request
     * @param T $data
     * @param iterable<string, string> $metadata
     */
    public function __construct(BindingRequest $request, $data, array $metadata)
    {
    }
}

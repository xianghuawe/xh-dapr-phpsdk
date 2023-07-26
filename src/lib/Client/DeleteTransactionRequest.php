<?php

namespace Dapr\Client;

use Dapr\consistency\Consistency;

/**
 * Class DeleteTransactionRequest
 * @package Dapr\Client
 */
class DeleteTransactionRequest extends StateTransactionRequest
{
    public string $operationType = 'delete';

    public function __construct(
        string       $key,
        string       $etag = '',
        array        $metadata = [],
        ?Consistency $consistency = null
    )
    {
    }
}

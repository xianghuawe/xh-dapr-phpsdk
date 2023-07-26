<?php

namespace Dapr;

/**
 * A parsed DAPR API response with metadata.
 * @package Dapr
 */
class DaprResponse
{
    public function __construct(
        int   $code = 0,
              $data = [],
              $etag = null,
        array $headers = []
    )
    {
    }
}

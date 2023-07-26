<?php

namespace Dapr\Actors;

use Dapr\Formats;
use Dapr\Serialization\ISerializer;
use Dapr\Serialization\Serializers\ISerialize;
use DateInterval;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Timer
 *
 * Abstracts actor timers.
 *
 * @package Dapr\Actors
 */
class Timer implements ISerialize
{
    public function __construct(
        string       $name,
        DateInterval $due_time,
        DateInterval $period,
        string       $callback,
                     $data = null
    )
    {
    }

    public function serialize($value, ISerializer $serializer): mixed
    {
        return $this->to_array();
    }


    public function to_array(): array
    {
        return [
            'dueTime' => Formats::normalize_interval($this->due_time),
            'period' => Formats::normalize_interval($this->period),
            'callback' => $this->callback,
            'data' => $this->data,
        ];
    }
}

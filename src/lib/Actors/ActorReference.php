<?php

namespace Dapr\Actors;

use Dapr\Actors\Attributes\DaprType;
use Dapr\Actors\Generators\ProxyFactory;
use Dapr\Deserialization\Deserializers\IDeserialize;
use Dapr\Deserialization\IDeserializer;
use Dapr\Serialization\ISerializer;
use Dapr\Serialization\Serializers\ISerialize;
use LogicException;
use ReflectionClass;

/**
 * Class ActorReference
 * @package Dapr\Actors
 */
final class ActorReference implements IActorReference, ISerialize, IDeserialize
{
    public function __construct(string $id, string $actor_type)
    {
    }

    /**
     * @inheritDoc
     */
    public static function get($actor): IActorReference
    {
        $id = $actor->get_id();

        if ($id === null) {
            throw new LogicException('actor(proxy) must implement get_id()');
        }

        $detected_dapr_type = self::get_dapr_type($actor);

        $dapr_type = $actor->DAPR_TYPE ?? $detected_dapr_type->type;

        if ($dapr_type === null) {
            throw new LogicException('Missing DaprType attribute on ' . $actor::class);
        }

        return new self($id, $dapr_type);
    }

    private static function get_dapr_type($type)
    {
        $reflector = new ReflectionClass($type);
        /**
         * @var DaprType|null $type_attribute
         */
        // todo
        $type_attribute = ($reflector->getAttributes(DaprType::class)[0] ?? null)?->newInstance();

        return $type_attribute;
    }

    public static function deserialize($value, IDeserializer $deserializer): mixed
    {
        return new ActorReference($value['ActorId'], $value['ActorType']);
    }

    /**
     * @inheritDoc
     */
    public function bind(string $interface, ProxyFactory $proxy_factory): mixed
    {
        return $proxy_factory->get_generator($interface, $this->actor_type)->get_proxy(
            $this->id
        );
    }

    /**
     * @inheritDoc
     */
    public function get_actor_id(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function get_actor_type(): string
    {
        return $this->actor_type;
    }

    /**
     * @param ActorReference $value
     * @param ISerializer $serializer
     *
     * @return array
     */
    public function serialize($value, ISerializer $serializer): array
    {
        return ['ActorId' => $value->id, 'ActorType' => $value->actor_type];
    }
}

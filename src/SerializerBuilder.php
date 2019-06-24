<?php


namespace OgcSerializer;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;

/**
 * Custom builder
 */
class OgcSerializerBuilder
{
    /**
     * Create serializer
     *
     * @return Serializer
     */
    public static function create(): Serializer
    {
        $serializer = SerializerBuilder::create();


        return $serializer->build();
    }
}

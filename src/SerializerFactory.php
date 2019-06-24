<?php


namespace OgcSerializer;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Naming\CamelCaseNamingStrategy;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Custom builder
 */
class SerializerFactory
{
    /**
     * Create JMS serializer with custom naming
     *
     * @return Serializer
     */
    public static function create(): Serializer
    {
        AnnotationRegistry::registerLoader('class_exists');
        $serializer = SerializerBuilder::create();
        $serializer->setPropertyNamingStrategy(
            new SerializedNameAnnotationStrategy(
                new CamelCaseNamingStrategy('_', false)
            )
        );
        return $serializer->build();
    }
}

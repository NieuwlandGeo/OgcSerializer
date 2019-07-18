<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Naming\CamelCaseNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Visitor\Factory\XmlDeserializationVisitorFactory;

/**
 * Custom builder.
 */
class SerializerFactory
{
    /**
     * Create JMS serializer with custom naming.
     *
     * @return Serializer
     */
    public static function create($doctypeWhitelist = []): Serializer
    {
        AnnotationRegistry::registerLoader('class_exists');
        $xmlVisitor = new XmlDeserializationVisitorFactory();
        $xmlVisitor->setDoctypeWhitelist($doctypeWhitelist);
        $builder = SerializerBuilder::create();
        $builder->setDeserializationVisitor('xml', $xmlVisitor);
        $builder->addDefaultSerializationVisitors();
        $builder->setPropertyNamingStrategy(
            new SerializedNameAnnotationStrategy(
                new CamelCaseNamingStrategy('', false)
            )
        );

        return $builder->build();
    }
}

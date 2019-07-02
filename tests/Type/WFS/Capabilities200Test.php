<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

use OgcSerializer\SerializerFactory;
use OgcSerializer\Type\WFS\Capabilities\Capabilities200;
use OgcSerializer\Type\WFS\Capabilities\FeatureType;
use OgcSerializer\Type\WFS\Capabilities\FeatureTypeList;
use PHPUnit\Framework\TestCase;

class Capabilities200Test extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities200();
        $this->assertInstanceOf(Capabilities200::class, $object);
    }

    public function testCanDeserializeGeoserver()
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(Capabilities200::class, $capabilities);
    }

    public function testReadServicePropsGeoserver()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(2, $capabilities->getFeatureTypeList()->getFeatureTypes());
    }

    public function testCanDeserializeMapserver()
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(Capabilities200::class, $capabilities);
    }

    public function testReadServicePropsMapserver()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(20, $capabilities->getFeatureTypeList()->getFeatureTypes());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSerialize()
    {
        $capabilities = new Capabilities200();
        $list         = new FeatureTypeList();
        $type         = new FeatureType();
        $type->setName('test');
        $type->setDefaultCRS('EPSG:28992');
        $list->setFeatureTypes([$type]);
        $capabilities->setFeatureTypeList($list);
        $serializer = SerializerFactory::create();
        $serializer->serialize($capabilities, 'xml');
    }
}
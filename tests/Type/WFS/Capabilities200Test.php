<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities as Capabilities200;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\FeatureType;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\FeatureTypeList;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class Capabilities200Test extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $object = new Capabilities200();
        $this->assertInstanceOf(Capabilities200::class, $object);
    }

    public function testCanDeserializeGeoserver(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(Capabilities200::class, $capabilities);
    }

    public function testReadServicePropsGeoserver(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertEquals('2.0.0', $capabilities->getVersion());
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(2, $capabilities->getFeatureTypeList()->getFeatureTypes());
        $this->assertCount(2, $capabilities->getLayerNames());
        $this->assertContains('weggeg:weggegaantalrijbanen', $capabilities->getLayerNames());
    }

    public function testCanDeserializeMapserver(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(Capabilities200::class, $capabilities);
    }

    public function testReadServicePropsMapserver(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(20, $capabilities->getFeatureTypeList()->getFeatureTypes());
        $this->assertCount(20, $capabilities->getLayerNames());
        $this->assertContains('ms:buurt', $capabilities->getLayerNames());
    }

    public function testReadProjections(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $layer        = $capabilities->getLayer('ms:buurt');
        $this->assertIsArray($layer->getCrsOptions());
        $this->assertContains('urn:ogc:def:crs:EPSG::28992', $layer->getCrsOptions());
        $this->assertContains('urn:ogc:def:crs:EPSG::4258', $layer->getCrsOptions());
        $this->assertEquals('urn:ogc:def:crs:EPSG::28992', $capabilities->getFeatureType('ms:buurt')->getDefaultCrs());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSerialize(): void
    {
        $capabilities = new Capabilities200();
        $list         = new FeatureTypeList();
        $type         = new FeatureType();
        $type->setName('test');
        $type->setDefaultCRS('EPSG:28992');
        $list->setFeatureTypes([$type]);
        $capabilities->setFeatureTypeList($list);
        $capabilities->setVersion('2.0.0');
        $serializer = SerializerFactory::create();
        $serializer->serialize($capabilities, 'xml');
    }
}

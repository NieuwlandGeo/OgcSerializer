<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\Capabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\FeatureTypeList;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class Capabilities110Test extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $object = new Capabilities();
        $this->assertInstanceOf(Capabilities::class, $object);
    }

    public function testCanDeserializeGeoserver(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
    }

    public function testReadServicePropsGeoserver(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertEquals('1.1.0', $capabilities->getVersion());
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(2, $capabilities->getFeatureTypeList()->getFeatureTypes());
        $this->assertCount(2, $capabilities->getLayerNames());
        $this->assertContains('weggeg:weggegaantalrijbanen', $capabilities->getLayerNames());
    }

    public function testReadProjections(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layer        = $capabilities->getLayer('weggeg:weggegaantalrijbanen');
        $this->assertIsArray($layer->getCrsOptions());
        $this->assertContains('urn:x-ogc:def:crs:EPSG:28992', $layer->getCrsOptions());
        $this->assertContains('urn:x-ogc:def:crs:EPSG:3035', $layer->getCrsOptions());
    }
}

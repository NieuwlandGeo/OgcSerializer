<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\Capabilities110;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\FeatureTypeList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\FeatureTypeList110;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class Capabilities110Test extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities110();
        $this->assertInstanceOf(Capabilities110::class, $object);
    }

    public function testCanDeserializeGeoserver()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities110 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities110::class, 'xml');
        $this->assertInstanceOf(Capabilities110::class, $capabilities);
        $this->assertInstanceOf(FeatureTypeList110::class, $capabilities->getFeatureTypeList());
    }

    public function testReadServicePropsGeoserver()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities110 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities110::class, 'xml');
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(2, $capabilities->getFeatureTypeList()->getFeatureTypes());
        $this->assertCount(2, $capabilities->getLayerNames());
        $this->assertContains('weggeg:weggegaantalrijbanen', $capabilities->getLayerNames());
    }

    public function testReadProjections()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities110 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities110::class, 'xml');
        $layer        = $capabilities->getLayer('weggeg:weggegaantalrijbanen');
        $this->assertIsArray($layer->getCrsOptions());
        $this->assertContains('urn:x-ogc:def:crs:EPSG:28992', $layer->getCrsOptions());
        $this->assertContains('urn:x-ogc:def:crs:EPSG:3035', $layer->getCrsOptions());
    }
}

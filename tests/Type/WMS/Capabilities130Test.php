<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\LayerInterface;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Capabilities130;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Layer;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Service;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class Capabilities130Test extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities130();
        $this->assertInstanceOf(Capabilities130::class, $object);
    }

    public function testCanDeserialize()
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $this->assertInstanceOf(Capabilities130::class, $capabilities);
    }

    public function testReadServiceProps()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $this->assertEquals('WMS', $capabilities->getService()->getName());
        $layerGroup = $capabilities->getCapability()->getLayer();
        $this->assertInstanceOf(Layer::class, $layerGroup);
        $this->assertCount(3, $layerGroup->getLayers());
        $this->assertContains('gemeenten', $capabilities->getLayerNames());
        $this->assertInstanceOf(LayerInterface::class, $capabilities->getLayer('gemeenten'));
    }

    public function testHasParent()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $parent       = $capabilities->getLayer('gemeenten')->getParent();
        $this->assertInstanceOf(LayerInterface::class, $parent);
        $this->assertEquals('Bestuurlijke grenzen WMS', $parent->getTitle());
    }

    public function testReadProjections()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertContains('EPSG:25831', $layer->getCrsOptions());
        $this->assertContains('EPSG:28992', $layer->getCrsOptions());
        $this->assertContains('CRS:84', $layer->getCrsOptions());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSerialize()
    {
        $capabilities = new Capabilities130();
        $service      = new Service();
        $service->setName('mijn test');
        $capabilities->setService($service);
        $serializer = SerializerFactory::create();
        $serializer->serialize($capabilities, 'xml');
    }
}

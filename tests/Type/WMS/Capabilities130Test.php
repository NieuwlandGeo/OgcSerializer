<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use OgcSerializer\SerializerFactory;
use OgcSerializer\Type\WMS\Capabilities\Capabilities130;
use OgcSerializer\Type\WMS\Capabilities\Service;
use PHPUnit\Framework\TestCase;
use OgcSerializer\Type\WMS\Capabilities\Layer;

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
        // var_dump($serializer->serialize($capabilities, 'xml'));
    }
}

<?php

declare(strict_types=1);

namespace Tests\Type\Generic;

use Nieuwland\OgcSerializer\Generic\ServiceCapabilitiesFactory;
use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Capabilities as WMS13Capabilities;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class ServiceCapabilitiesFactoryTest extends TestCase
{
    public function testWMTSTitle(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertEquals($genericCapabilities->getTitle(), 'Web Map Tile Service');
    }

    public function testWMTSLayerNames(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(1, $genericCapabilities->getLayerNames());
        $this->assertContains('coastlines', $genericCapabilities->getLayerNames());
    }

    public function testWMSTitle(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMS/example_capabilities_sld.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, WMS13Capabilities::class, 'xml');
        $this->assertInstanceOf(WMS13Capabilities::class, $capabilities);
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertEquals($genericCapabilities->getTitle(), 'Acme Corp. Map Server');
    }

    public function testWMSLayerNames(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WMS/example_capabilities_sld.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WMS13Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(8, $genericCapabilities->getLayerNames());
    }

    public function testWFSTitle(): void
    {
    }
}

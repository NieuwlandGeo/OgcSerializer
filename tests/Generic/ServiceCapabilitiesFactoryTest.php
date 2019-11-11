<?php

declare(strict_types=1);

namespace Tests\Type\Generic;

use Nieuwland\OgcSerializer\Generic\ServiceCapabilitiesFactory;
use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\Capabilities as WFS11Capabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities as WFS2Capabilities;
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

    public function testWFS2Title(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS2Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertEquals($genericCapabilities->getTitle(), 'Weggegevens WFS');
    }

    public function testWFS2Layers(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS2Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(2, $genericCapabilities->getLayerNames());
        $this->assertContains(
            'urn:ogc:def:crs:EPSG::3035',
            $genericCapabilities->getLayer('weggeg:weggegmaximumsnelheden')->getProjections()
        );
        $this->assertContains(
            'gml32',
            $genericCapabilities->getLayer('weggeg:weggegmaximumsnelheden')->getDataFormats()
        );
    }

    public function testWFS11Title(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS11Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertEquals($genericCapabilities->getTitle(), 'Weggegevens WFS');
    }

    public function testWFS11Layers(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS11Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(2, $genericCapabilities->getLayerNames());
        $this->assertContains(
            'urn:x-ogc:def:crs:EPSG:3035',
            $genericCapabilities->getLayer('weggeg:weggegmaximumsnelheden')->getProjections()
        );
        $this->assertContains(
            'gml32',
            $genericCapabilities->getLayer('weggeg:weggegmaximumsnelheden')->getDataFormats()
        );
    }
}

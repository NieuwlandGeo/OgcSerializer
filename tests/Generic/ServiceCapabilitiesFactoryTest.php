<?php

declare(strict_types=1);

namespace Tests\Type\Generic;

use Nieuwland\OgcSerializer\Generic\LayerCapabilitiesInterface;
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

    public function testWMTSLayers(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(1, $genericCapabilities->getLayerNames());
        $this->assertContains('coastlines', $genericCapabilities->getLayerNames());
        $this->assertFalse($genericCapabilities->hasLayer('coastlinesss'));
        $this->assertTrue($genericCapabilities->hasLayer('coastlines'));
        $layer = $genericCapabilities->getLayer('coastlines');
        $this->assertInstanceOf(LayerCapabilitiesInterface::class, $layer);
        $this->assertContains('image/png', $layer->getDataFormats());
        $this->assertContains(
            'urn:ogc:def:crs:OGC:1.3:CRS84',
            $genericCapabilities->getLayer('coastlines')->getProjections()
        );
        $this->assertEquals('Coastlines', $layer->getTitle());
    }

    public function testWMSTitle(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMS/example_capabilities_sld.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, WMS13Capabilities::class, 'xml');
        $this->assertInstanceOf(WMS13Capabilities::class, $capabilities);
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertEquals('Acme Corp. Map Server', $genericCapabilities->getTitle());
        $this->assertEquals(['1.3.0'], $genericCapabilities->getVersions());
    }

    public function testWMSLayers(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WMS/example_capabilities_sld.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WMS13Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(8, $genericCapabilities->getLayerNames());
        $layer = $genericCapabilities->getLayer('ROADS_RIVERS');
        $this->assertInstanceOf(LayerCapabilitiesInterface::class, $layer);
        $this->assertContains('EPSG:26986', $layer->getProjections());
        $this->assertEquals('ROADS_RIVERS', $layer->getName());
        $this->assertEquals('Roads and Rivers', $layer->getTitle());
    }

    public function testWFS2Title(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS2Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertEquals('Weggegevens WFS', $genericCapabilities->getTitle());
    }

    public function testWFS2Layers(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS2Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(2, $genericCapabilities->getLayerNames());
        $layer = $genericCapabilities->getLayer('weggeg:weggegmaximumsnelheden');
        $this->assertContains(
            'urn:ogc:def:crs:EPSG::3035',
            $layer->getProjections()
        );
        $this->assertContains(
            'gml32',
            $layer->getDataFormats()
        );
        $this->assertEquals('weggegmaximumsnelheden', $layer->getTitle());
    }

    public function testWFS11Title(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS11Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertEquals('Weggegevens WFS', $genericCapabilities->getTitle());
    }

    public function testWFS11Layers(): void
    {
        $xml                 = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok_11.xml');
        $serializer          = SerializerFactory::create();
        $capabilities        = $serializer->deserialize($xml, WFS11Capabilities::class, 'xml');
        $genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
        $this->assertCount(2, $genericCapabilities->getLayerNames());
        $layer = $genericCapabilities->getLayer('weggeg:weggegmaximumsnelheden');
        $this->assertContains(
            'urn:x-ogc:def:crs:EPSG:3035',
            $layer->getProjections()
        );
        $this->assertContains(
            'gml32',
            $layer->getDataFormats()
        );
        $this->assertEquals('weggegmaximumsnelheden', $layer->getTitle());
    }
}

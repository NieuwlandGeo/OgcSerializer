<?php

declare(strict_types=1);

namespace Tests\Type\Generic;

use Nieuwland\OgcSerializer\Generic\WMTSServiceAdapter;
use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class WMTSServiceAdapterTest extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
        new WMTSServiceAdapter($capabilities);
    }

    public function testTitle(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
        $genericCapabilities = new WMTSServiceAdapter($capabilities);
        $this->assertEquals($genericCapabilities->getTitle(), 'Web Map Tile Service');
    }

    public function testLayerNames(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
        $genericCapabilities = new WMTSServiceAdapter($capabilities);
        $this->assertCount(1, $genericCapabilities->getLayerNames());
        $this->assertContains('coastlines', $genericCapabilities->getLayerNames());
    }
}

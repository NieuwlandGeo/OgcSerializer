<?php

declare(strict_types=1);

namespace Tests\Type\WMTS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Layer;
use PHPUnit\Framework\TestCase;
use function current;
use function file_get_contents;

class CapabilitiesTest extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $object = new Capabilities();
        $this->assertInstanceOf(Capabilities::class, $object);
    }

    public function testCanDeserialize(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
    }

    public function testHasLayers(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertCount(1, $capabilities->getContents()->getLayers(), 'expected contents to have 1 layer object');
        $this->assertCount(1, $capabilities->getLayerNames());
        $this->assertSame(['coastlines'], $capabilities->getLayerNames());
    }

    public function testTileMatrixSetLinks(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layers       = $capabilities->getContents()->getLayers();
        /** @var Layer $layer */
        $layer = current($layers);
        $this->assertCount(1, $layer->getTileMatrixSetLinks());
        $tileMatrixSet = $layer->getTileMatrixSetLinks()['0']->getTileMatrixSet();
        $this->assertEquals('BigWorld', $tileMatrixSet);
    }

    public function testTileMatrixSets(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $matrixes     = $capabilities->getContents()->getTileMatrixSets();
        $this->assertCount(1, $matrixes);
        $tileMatrixes = $matrixes['0']->getTileMatrixes();
        $this->assertEquals('BigWorld', $matrixes['0']->getIdentifier());
        $this->assertEquals('urn:ogc:def:crs:OGC:1.3:CRS84', $matrixes['0']->getSupportedCRS());
        $this->assertCount(2, $tileMatrixes);
        $this->assertEquals(256, $tileMatrixes[0]->getTileWidth());
        $this->assertEquals(256, $tileMatrixes[0]->getTileHeight());
    }

    public function testFormats(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layers       = $capabilities->getContents()->getLayers();
        /** @var Layer $layer */
        $layer = current($layers);
        $this->assertCount(2, $layer->getFormats());
        $this->assertSame([
            'image/png',
            'image/gif',
        ], $layer->getFormats());
    }

    public function testStyles(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layers       = $capabilities->getContents()->getLayers();
        /** @var Layer $layer */
        $layer  = current($layers);
        $styles = $layer->getStyles();
        $this->assertCount(2, $styles);
        foreach ($styles as $style) {
            $this->assertNotEmpty($style->getIdentifier());
            $this->assertNotEmpty($style->getTitle());
        }
        $this->assertTrue($styles['0']->getIsDefault());
        $this->assertFalse($styles['1']->getIsDefault());
        $this->assertEquals('image/png', $styles['0']->getLegendurl()->getFormat());
        $this->assertEquals(
            'http://www.miramon.uab.es/wmts/Coastlines/coastlines_darkBlue.png',
            $styles['0']->getLegendurl()->getHref()
        );
    }
}

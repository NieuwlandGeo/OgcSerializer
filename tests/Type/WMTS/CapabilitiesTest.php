<?php

declare(strict_types=1);

namespace Tests\Type\WMTS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class CapabilitiesTest extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities();
        $this->assertInstanceOf(Capabilities::class, $object);
    }

    public function testCanDeserialize()
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
    }

    public function testHasLayers()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMTS/wmtsGetCapabilities_response.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertCount(1, $capabilities->getContents()->getLayers(), 'expected contents to have 1 layer object');
        $this->assertCount(1, $capabilities->getLayerNames());
    }
}

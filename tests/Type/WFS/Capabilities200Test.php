<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

use OgcSerializer\SerializerFactory;
use OgcSerializer\Type\WFS\Capabilities200;
use PHPUnit\Framework\TestCase;

class Capabilities200Test extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities200();
        $this->assertInstanceOf(Capabilities200::class, $object);
    }

    public function testCanDeserialize()
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(Capabilities200::class, $capabilities);
    }

    public function testReadServiceProps()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
    }
}

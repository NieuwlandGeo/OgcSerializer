<?php

use PHPUnit\Framework\TestCase;
use OgcClient\Type\WMS\Capabilities130;
use JMS\Serializer\SerializerBuilder;

class Capabilities130Test extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities130();
        $this->assertInstanceOf(Capabilities130::class, $object);
    }


    public function testCanDeserialize()
    {
        $xml = file_get_contents(FIXTURE_PATH.'/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerBuilder::create()->build();
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $this->assertInstanceOf(Capabilities130::class, $capabilities);
    }
}

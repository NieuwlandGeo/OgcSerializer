<?php

use PHPUnit\Framework\TestCase;
use OgcClient\Type\WMS\Capabilities\Capabilities130;
use JMS\Serializer\SerializerBuilder;
use Doctrine\Common\Annotations\AnnotationRegistry;
use OgcClient\Type\WMS\Capabilities\Service;

class Capabilities130Test extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        AnnotationRegistry::registerLoader('class_exists');
    }
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

    public function testReadServiceProps()
    {
        $xml = file_get_contents(FIXTURE_PATH.'/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerBuilder::create()->build();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $this->assertEquals('WMS', $capabilities->getService()->getName());
    }


    public function testSerialize()
    {
        $capabilities = new Capabilities130();
        $service = new Service();
        $service->setName('mijn test');
        $capabilities->setService($service);
        $serializer = SerializerBuilder::create()->build();
        // var_dump($serializer->serialize($capabilities, 'xml'));
    }
}

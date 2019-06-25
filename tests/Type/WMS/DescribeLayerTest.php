<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use OgcSerializer\SerializerFactory;
use OgcSerializer\Type\WMS\DescribeLayer\DescribeLayerResponse;
use PHPUnit\Framework\TestCase;

class DescribeLayerTest extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new DescribeLayerResponse();
        $this->assertInstanceOf(DescribeLayerResponse::class, $object);
    }

    public function testCanDeserialize()
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMS/DescribeLayer_pdok.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, DescribeLayerResponse::class, 'xml');
        $this->assertInstanceOf(DescribeLayerResponse::class, $capabilities);
    }

    public function testReadProps()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/DescribeLayer_pdok.xml');
        $serializer = SerializerFactory::create();
        /** @var DescribeLayerResponse $descr */
        $descr = $serializer->deserialize($xml, DescribeLayerResponse::class, 'xml');
    }
}

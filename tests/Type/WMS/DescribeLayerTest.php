<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WMS\DescribeLayer\DescribeLayerResponse;
use Nieuwland\OgcSerializer\Type\WMS\DescribeLayer\LayerDescription;
use Nieuwland\OgcSerializer\Type\WMS\DescribeLayer\Query;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

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
        $serializer   = SerializerFactory::create(
            ['<!DOCTYPE WMS_DescribeLayerResponse SYSTEM "https://geodata.nationaalgeoregister.nl/schemas/wms/1.1.1/WMS_DescribeLayerResponse.dtd">']
        );
        $capabilities = $serializer->deserialize($xml, DescribeLayerResponse::class, 'xml');
        $this->assertInstanceOf(DescribeLayerResponse::class, $capabilities);
    }

    public function testReadProps()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/DescribeLayer_pdok.xml');
        $serializer = SerializerFactory::create(
            ['<!DOCTYPE WMS_DescribeLayerResponse SYSTEM "https://geodata.nationaalgeoregister.nl/schemas/wms/1.1.1/WMS_DescribeLayerResponse.dtd">']
        );
        /** @var DescribeLayerResponse $descr */
        $descr = $serializer->deserialize($xml, DescribeLayerResponse::class, 'xml');
        $this->assertInstanceOf(LayerDescription::class, $descr->getLayerDescription());
        $this->assertEquals('kruising', $descr->getLayerDescription()->getName());
        $this->assertEquals(
            'https://geodata.nationaalgeoregister.nl/spoorwegen/wfs?',
            $descr->getLayerDescription()->getWfs()
        );
        $this->assertInstanceOf(Query::class, $descr->getLayerDescription()->getQuery());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSerialize()
    {
        $desc = new LayerDescription();
        $desc->setName('test');
        $resp = new DescribeLayerResponse();
        $resp->setLayerDescription($desc);
        $serializer = SerializerFactory::create();
    }
}

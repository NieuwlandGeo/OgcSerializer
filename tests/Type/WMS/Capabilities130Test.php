<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\LayerInterface;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\BoundingBox;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Capabilities130;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\ExGeographicBoundingBox;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Layer;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\OperationType;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Request;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Service;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Style;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class Capabilities130Test extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities130();
        $this->assertInstanceOf(Capabilities130::class, $object);
    }

    public function testCanDeserialize()
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $this->assertInstanceOf(Capabilities130::class, $capabilities);
    }

    public function testReadServiceProps()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $this->assertEquals('WMS', $capabilities->getService()->getName());
        $layerGroup = $capabilities->getCapability()->getLayer();
        $this->assertInstanceOf(Layer::class, $layerGroup);
        $this->assertCount(3, $layerGroup->getLayers());
        $this->assertContains('gemeenten', $capabilities->getLayerNames());
        $this->assertInstanceOf(LayerInterface::class, $capabilities->getLayer('gemeenten'));
    }

    public function testHasParent()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $parent       = $capabilities->getLayer('gemeenten')->getParent();
        $this->assertInstanceOf(LayerInterface::class, $parent);
        $this->assertEquals('Bestuurlijke grenzen WMS', $parent->getTitle());
    }

    public function testReadProjections()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertIsArray($layer->getCrsOptions());
        $this->assertContains('EPSG:25831', $layer->getCrsOptions());
        $this->assertContains('EPSG:28992', $layer->getCrsOptions());
        $this->assertContains('CRS:84', $layer->getCrsOptions());
    }

    public function testReadExGeographicBoundingBox()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertInstanceOf(ExGeographicBoundingBox::class, $layer->getExGeographicBoundingBoxOption());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getWestBoundLongitude());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getEastBoundLongitude());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getSouthBoundLatitude());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getNorthBoundLatitude());
    }

    public function testReadStyles()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertIsArray($layer->getStyleOptions());
        $this->assertIsArray($layer->getStyles());
        $style = $layer->getStyle('bestuurlijkegrenzen:bestuurlijkegrenzen_gemeentegrenzen');
        $this->assertInstanceOf(
            Style::class,
            $style
        );
        $this->assertEquals('gemeenten', $style->getTitle());
    }

    public function testReadBoundingBoxes()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertIsArray($layer->getBoundingBoxOptions());
        $this->assertInstanceOf(BoundingBox::class, $layer->getBoundingBoxOption('EPSG:28992'));
        $this->assertEquals(278026.09, $layer->getBoundingBoxOption('EPSG:28992')->getMaxx());
    }

    public function testRequest()
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities130 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
        $request      = $capabilities->getCapability()->getRequest();

        $this->assertInstanceOf(Request::class, $request);
        $this->assertInstanceOf(OperationType::class, $request->getGetFeatureInfo());
        $this->assertIsArray($request->getGetFeatureInfo()->getFormat());
        $this->assertContains('application/json', $request->getGetFeatureInfo()->getFormat());
        $this->assertInstanceOf(OperationType::class, $request->getGetMap());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSerialize()
    {
        $capabilities = new Capabilities130();
        $service      = new Service();
        $service->setName('mijn test');
        $capabilities->setService($service);
        $serializer = SerializerFactory::create();
        $serializer->serialize($capabilities, 'xml');
    }
}

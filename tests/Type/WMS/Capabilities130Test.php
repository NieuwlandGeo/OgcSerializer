<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\LayerInterface;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\BoundingBox;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Capabilities;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\ExGeographicBoundingBox;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Layer;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OperationType;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Request;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Service;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Style;
use PHPUnit\Framework\TestCase;

use function file_get_contents;

class Capabilities130Test extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $object = new Capabilities();
        $this->assertInstanceOf(Capabilities::class, $object);
    }

    public function testCanDeserialize(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertInstanceOf(Capabilities::class, $capabilities);
    }

    public function testReadServiceProps(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertEquals('WMS', $capabilities->getService()->getName());
        $this->assertEquals('Bestuurlijke grenzen WMS', $capabilities->getService()->getTitle());
        $layerGroup = $capabilities->getCapability()->getLayer();
        $this->assertInstanceOf(Layer::class, $layerGroup);
        $this->assertCount(3, $layerGroup->getLayers());
        $this->assertContains('gemeenten', $capabilities->getLayerNames());
        $this->assertInstanceOf(LayerInterface::class, $capabilities->getLayer('gemeenten'));
    }

    public function testHasParent(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $parent       = $capabilities->getLayer('gemeenten')->getParent();
        $this->assertInstanceOf(LayerInterface::class, $parent);
        $this->assertEquals('Bestuurlijke grenzen WMS', $parent->getTitle());
    }

    public function testReadProjections(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertIsArray($layer->getCrsOptions());
        $this->assertContains('EPSG:25831', $layer->getCrsOptions());
        $this->assertContains('EPSG:28992', $layer->getCrsOptions());
        $this->assertContains('CRS:84', $layer->getCrsOptions());
    }

    public function testReadExGeographicBoundingBox(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertInstanceOf(ExGeographicBoundingBox::class, $layer->getExGeographicBoundingBoxOption());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getWestBoundLongitude());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getEastBoundLongitude());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getSouthBoundLatitude());
        $this->assertIsFloat($layer->getExGeographicBoundingBoxOption()->getNorthBoundLatitude());
    }

    public function testReadStyles(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertIsArray($layer->getStyleOptions());
        $this->assertIsArray($layer->getStyles());
        $style = $layer->getStyle('bestuurlijkegrenzen:bestuurlijkegrenzen_gemeentegrenzen');
        $this->assertInstanceOf(
            Style::class,
            $style
        );
        $this->assertContains('gemeenten', $layer->getStyleNames());
        $this->assertArrayHasKey('bestuurlijkegrenzen:bestuurlijkegrenzen_gemeentegrenzen', $layer->getStyleNames());
        $this->assertEquals('gemeenten', $style->getTitle());
    }

    public function testReadStyleLegend(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $style        = $layer->getStyle('bestuurlijkegrenzen:bestuurlijkegrenzen_gemeentegrenzen');
        $legendUrl    = $style->getLegendURL();
        $this->assertEquals('94', $legendUrl['0']->getWidth());
        $this->assertEquals('40', $legendUrl['0']->getHeight());
        $this->assertEquals('40', $legendUrl['0']->getHeight());
        $this->assertEquals(
            'https://geodata.nationaalgeoregister.nl/bestuurlijkegrenzen/ows?service=WMS&request=GetLegendGraphic&format=image%2Fpng&width=20&height=20&layer=gemeenten',
            $legendUrl['0']->getOnlineResource()->getHref()
        );
    }

    public function testReadBoundingBoxes(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $layer        = $capabilities->getLayer('gemeenten');
        $this->assertIsArray($layer->getBoundingBoxOptions());
        $this->assertInstanceOf(BoundingBox::class, $layer->getBoundingBoxOption('EPSG:28992'));
        $this->assertEquals(278026.09, $layer->getBoundingBoxOption('EPSG:28992')->getMaxx());
    }

    public function testRequest(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $request      = $capabilities->getCapability()->getRequest();

        $this->assertInstanceOf(Request::class, $request);
        $this->assertInstanceOf(OperationType::class, $request->getGetFeatureInfo());
        $this->assertIsArray($request->getGetFeatureInfo()->getFormat());
        $this->assertContains('application/json', $request->getGetFeatureInfo()->getFormat());
        $this->assertInstanceOf(OperationType::class, $request->getGetMap());
    }

    public function testExampleSLD(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/example_capabilities_sld.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');

        //service tests
        $this->assertInstanceOf(Service::class, $capabilities->getService());
        $this->assertEquals('Acme Corp. Map Server', $capabilities->getService()->getTitle());
        $this->assertEquals(
            'Map Server maintained by Acme Corporation.  Contact: webmaster@wmt.acme.com.  High-quality maps showing roadrunner nests and possible ambush locations.',
            $capabilities->getService()->getAbstract()
        );

        // request tests
        $request = $capabilities->getCapability()->getRequest();
        //describe layer
        $this->assertInstanceOf(OperationType::class, $request->getDescribeLayer());
        $this->assertIsArray($request->getDescribeLayer()->getFormat());
        $this->assertContains('text/xml', $request->getDescribeLayer()->getFormat());
        //layernames
        $this->assertContains('ROADS_1M', $capabilities->getLayerNames());
        // operations in request
        $this->assertInstanceOf(OperationType::class, $request->getGetMap());
        $this->assertInstanceOf(OperationType::class, $request->getGetFeatureInfo());
        $this->assertInstanceOf(OperationType::class, $request->getDescribeLayer());

        // bounding box inheterance
        $layer = $capabilities->getLayer('ROADS_RIVERS');
        $this->assertIsArray($layer->getBoundingBoxOptions());
        $this->assertContains('EPSG:26986', $layer->getCrs());
    }

    public function testEmptyLayers(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/EmptyLayers.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');

        $this->assertIsArray($capabilities->getLayerNames());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSerialize(): void
    {
        $capabilities = new Capabilities();
        $service      = new Service();
        $service->setName('mijn test');
        $capabilities->setService($service);
        $serializer = SerializerFactory::create();
        $serializer->serialize($capabilities, 'xml');
    }

    public function testMetadataURL(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WMS/Capabilities_geoserver_pdok_130.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities::class, 'xml');
        $this->assertCount(3, $capabilities->getLayerNames());
        foreach ($capabilities->getLayerNames() as $layerName) {
            $this->assertCount(1, $capabilities->getLayer($layerName)->getMetadataURLs());
        }

        $this->assertEquals(
            'http://nationaalgeoregister.nl/geonetwork/srv/dut/xml.metadata.get?uuid=c5c4a6d6-b850-473c-8ab5-af9c2c550809',
            $capabilities->getLayer('gemeenten')->getMetadataURL()
        );
        $this->assertEquals(
            'http://nationaalgeoregister.nl/geonetwork/srv/dut/xml.metadata.get?uuid=c5c4a6d6-b850-473c-8ab5-af9c2c550809',
            $capabilities->getLayer('landsgrens')->getMetadataURL()
        );
        $this->assertEquals(
            'http://nationaalgeoregister.nl/geonetwork/srv/dut/xml.metadata.get?uuid=c5c4a6d6-b850-473c-8ab5-af9c2c550809',
            $capabilities->getLayer('provincies')->getMetadataURL()
        );
    }
}

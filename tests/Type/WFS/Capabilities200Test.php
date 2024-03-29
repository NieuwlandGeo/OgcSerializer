<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities as Capabilities200;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\FeatureType;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\FeatureTypeList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\OperationsMetadata;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\ServiceIdentification;
use PHPUnit\Framework\TestCase;

use function file_get_contents;

class Capabilities200Test extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $object = new Capabilities200();
        $this->assertInstanceOf(Capabilities200::class, $object);
    }

    public function testCanDeserializeGeoserver(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(Capabilities200::class, $capabilities);
    }

    /**
     * Does not throw on empty/missing elements.
     *
     * @doesNotPerformAssertions
     */
    public function testCanDeserializeEmptyTypeList(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/CapabilitiesEmptyTypeList.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $capabilities->getFeatureTypeList();
        foreach ($capabilities->getOperationsMetadata()->getOperations() as $operation) {
            $operation->getParameters();
        }
    }

    public function testReadServicePropsGeoserver(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertEquals('2.0.0', $capabilities->getVersion());
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(2, $capabilities->getFeatureTypeList()->getFeatureTypes());
        $this->assertCount(2, $capabilities->getLayerNames());
        $this->assertContains('weggeg:weggegaantalrijbanen', $capabilities->getLayerNames());
    }

    public function testCanDeserializeMapserver(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(Capabilities200::class, $capabilities);
    }

    public function testReadServicePropsMapserver(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $this->assertInstanceOf(FeatureTypeList::class, $capabilities->getFeatureTypeList());
        $this->assertCount(20, $capabilities->getFeatureTypeList()->getFeatureTypes());
        $this->assertCount(20, $capabilities->getLayerNames());
        $this->assertContains('ms:buurt', $capabilities->getLayerNames());
    }

    public function testReadProjections(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_mapserver_adam_gebieden-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $layer        = $capabilities->getLayer('ms:buurt');
        $this->assertIsArray($layer->getCrsOptions());
        $this->assertContains('urn:ogc:def:crs:EPSG::28992', $layer->getCrsOptions());
        $this->assertContains('urn:ogc:def:crs:EPSG::4258', $layer->getCrsOptions());
        $this->assertEquals('urn:ogc:def:crs:EPSG::28992', $capabilities->getFeatureType('ms:buurt')->getDefaultCrs());
    }

    public function testServiceIdentification(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities   = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $identification = $capabilities->getServiceIdentification();
        $this->assertInstanceOf(ServiceIdentification::class, $identification);
        $this->assertEquals('Weggegevens WFS', $identification->getTitle());
    }

    public function testOperationsMetadata(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities   = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $operationsMeta = $capabilities->getOperationsMetadata();
        $this->assertInstanceOf(OperationsMetadata::class, $operationsMeta);
        $this->assertIsArray($operationsMeta->getOperations());
        $capOperation = $operationsMeta->getOperations()['GetCapabilities'];
        $this->assertEquals('GetCapabilities', $capOperation->getName());
        $this->assertIsArray($capOperation->getParameters());
        $versionParam = $capOperation->getParameter('AcceptVersions');
        $this->assertEquals('AcceptVersions', $versionParam->getName());
        $this->assertCount(3, $versionParam->getAllowedValues()->getValues());
        $this->assertNull($versionParam->getNoValues());
    }

    public function testTransactionOperation(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/GetCapabilities_Res_01.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities   = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $operationsMeta = $capabilities->getOperationsMetadata();
        $this->assertInstanceOf(OperationsMetadata::class, $operationsMeta);
        $this->assertIsArray($operationsMeta->getOperations());
        $operation = $operationsMeta->getOperation('Transaction');
        $this->assertEquals('Transaction', $operation->getName());
        $operation->getConstraint('Unknown');
        $autolockconstraint = $operation->getConstraint('AutomaticDataLocking');
        $this->assertEquals('TRUE', $autolockconstraint->getDefaultValue());
        $this->assertEquals('', $autolockconstraint->getNoValues());
        $orderconstraint = $operation->getConstraint('PreservesSiblingOrder');
        $this->assertEquals('TRUE', $orderconstraint->getDefaultValue());
    }

    public function testMissingTransactionOperation(): void
    {
        $xml        = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer = SerializerFactory::create();
        /** @var Capabilities200 $capabilities */
        $capabilities   = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $operationsMeta = $capabilities->getOperationsMetadata();
        $this->assertInstanceOf(OperationsMetadata::class, $operationsMeta);
        $this->assertIsArray($operationsMeta->getOperations());
        $this->assertNull($operationsMeta->getOperation('Transaction'));
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSerialize(): void
    {
        $capabilities   = new Capabilities200();
        $list           = new FeatureTypeList();
        $type           = new FeatureType();
        $identification = new ServiceIdentification();
        $identification->setTitle('test');
        $capabilities->setServiceIdentification($identification);
        $type->setName('test');
        $type->setDefaultCRS('EPSG:28992');
        $list->setFeatureTypes([$type]);
        $capabilities->setFeatureTypeList($list);
        $capabilities->setVersion('2.0.0');
        $serializer = SerializerFactory::create();
    }

    public function testMetadataURL(): void
    {
        $xml          = file_get_contents(FIXTURE_PATH . '/WFS/Capabilities_geoserver_pdok-20.xml');
        $serializer   = SerializerFactory::create();
        $capabilities = $serializer->deserialize($xml, Capabilities200::class, 'xml');
        $featureTypes = $capabilities->getFeatureTypeList()->getFeatureTypes();
        $this->assertCount(2, $featureTypes);
        foreach ($featureTypes as $featureType) {
            $this->assertCount(1, $featureType->getMetadataURLs());
        }

        $this->assertCount(1, $featureTypes['weggeg:weggegaantalrijbanen']->getMetadataURLs());
        $this->assertCount(1, $featureTypes['weggeg:weggegmaximumsnelheden']->getMetadataURLs());
        $this->assertEquals(
            'http://nationaalgeoregister.nl/geonetwork/srv/dut/xml.metadata.get?uuid=27df6b33-194c-46d6-ac94-257c306c91f2',
            $featureTypes['weggeg:weggegaantalrijbanen']->getMetadataURL()
        );
        $this->assertEquals(
            'http://nationaalgeoregister.nl/geonetwork/srv/dut/xml.metadata.get?uuid=abaf1e22-55aa-4a11-a855-7ac963e4a82b',
            $featureTypes['weggeg:weggegmaximumsnelheden']->getMetadataURL()
        );
    }
}

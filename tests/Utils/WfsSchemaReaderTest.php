<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

use Nieuwland\OgcSerializer\Utils\WfsSchemaElement;
use Nieuwland\OgcSerializer\Utils\WfsSchemaException;
use Nieuwland\OgcSerializer\Utils\WfsSchemaReader;
use PHPUnit\Framework\TestCase;

use function file_get_contents;

class WfsSchemaReaderTest extends TestCase
{
    /**
     * Undocumented variable.
     *
     * @var WfsSchemaReader
     */
    private $wfsSchema;

    protected function setUp(): void
    {
        $this->wfsSchema = new WfsSchemaReader();
    }

    public function testExtractFieldsFromGemeentenPdok(): void
    {
        $xml    = file_get_contents(FIXTURE_PATH . '/WFS/DescribeFeatureType_geoserver_pdok.xml');
        $fields = $this->wfsSchema->extractFields($xml, 'bestuurlijkegrenzen:gemeenten');
        $this->assertCount(3, $fields);
        foreach ($fields as $field) {
            $this->assertInstanceOf(WfsSchemaElement::class, $field);
            $this->assertIsString($field->getName());
            $this->assertIsString($field->getTypeName());
            $this->assertStringNotContainsString(':', $field->getTypeName());
            $this->assertIsInt($field->getMinOccurs());
            $this->assertIsBool($field->getNillable());
        }
    }

    public function testExtractFieldsFromProvinciePdok(): void
    {
        $xml    = file_get_contents(FIXTURE_PATH . '/WFS/DescribeFeatureType_geoserver_pdok.xml');
        $fields = $this->wfsSchema->extractFields($xml, 'bestuurlijkegrenzen:provincies');
        $this->assertCount(2, $fields);
        foreach ($fields as $field) {
            $this->assertInstanceOf(WfsSchemaElement::class, $field);
        }
    }

    public function testExtractFieldsFromDamo(): void
    {
        $xml    = file_get_contents(FIXTURE_PATH . '/WFS/damo_describefeaturetype.xml');
        $fields = $this->wfsSchema->extractFields($xml, 'DAMO_S:AFSLUITMIDDEL');
        $this->assertCount(17, $fields);
        foreach ($fields as $field) {
            $this->assertInstanceOf(WfsSchemaElement::class, $field);
        }
    }

    public function testExtractFieldsFromAdam(): void
    {
        $xml    = file_get_contents(FIXTURE_PATH . '/WFS/overlastgebieden_describefeaturetype.xml');
        $fields = $this->wfsSchema->extractFields($xml, 'ms:algemeen_overlastgebied');
        $this->assertCount(7, $fields);
        foreach ($fields as $field) {
            $this->assertInstanceOf(WfsSchemaElement::class, $field);
            $this->assertIsString($field->getName());
            $this->assertIsString($field->getTypeName());
            $this->assertStringNotContainsString(':', $field->getTypeName());
            $this->assertIsInt($field->getMinOccurs());
            $this->assertNull($field->getNillable());
        }
    }

    public function testExtractFieldsFromDuiker(): void
    {
        $xml    = file_get_contents(FIXTURE_PATH . '/WFS/DescribeFeatureType_arcgis.xsd');
        $fields = $this->wfsSchema->extractFields($xml, 'Extern:DUIKER');
        $this->assertCount(4, $fields);
        foreach ($fields as $field) {
            $this->assertInstanceOf(WfsSchemaElement::class, $field);
            $this->assertIsString($field->getName());
            $this->assertIsString($field->getTypeName());
            $this->assertStringNotContainsString(':', $field->getTypeName());
            $this->assertIsInt($field->getMinOccurs());
        }
    }

    public function testExceptionWhenEmptyString(): void
    {
        $this->expectException(WfsSchemaException::class);
        $xml    = '';
        $fields = $this->wfsSchema->extractFields($xml, 'ms:algemeen_overlastgebied');
    }
}

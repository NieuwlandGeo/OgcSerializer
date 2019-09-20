<?php

declare(strict_types=1);

namespace Tests\Type\WFS;

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

    public function testExtractFieldsFromPdok()
    {
        $xml = file_get_contents(FIXTURE_PATH . '/WFS/DescribeFeatureType_geoserver_pdok.xml');
        $this->wfsSchema->extractFields($xml, 'bestuurlijkegrenzen:gemeenten');
    }
}

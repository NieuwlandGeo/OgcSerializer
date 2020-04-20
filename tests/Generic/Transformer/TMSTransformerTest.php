<?php

declare(strict_types=1);

namespace Tests\Type\Generic\Transformer;

use Nieuwland\OgcSerializer\Generic\Transformer\TMSTransformer;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class TMSTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $xml = file_get_contents(FIXTURE_PATH . '/TMS/tilemap.xml');

        $transformer = new TMSTransformer();
        $capabilties = $transformer->transform($xml);

        $this->assertEquals('brtachtergrondkaart', $capabilties->getTitle());
        $this->assertContains('brtachtergrondkaart', $capabilties->getLayerNames());
        $this->assertContains('EPSG:28992', $capabilties->getLayer('brtachtergrondkaart')->getProjections());
    }
}

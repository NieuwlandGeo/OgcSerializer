<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use Nieuwland\OgcSerializer\Exception\UnexpectedValueException;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Layer;
use PHPUnit\Framework\TestCase;

class LayerTest extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $object = new Layer();
        $this->expectException(UnexpectedValueException::class);
        $object->getTitle();
    }
}

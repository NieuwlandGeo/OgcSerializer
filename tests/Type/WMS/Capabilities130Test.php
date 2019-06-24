<?php

use PHPUnit\Framework\TestCase;
use OgcClient\Type\WMS\Capabilities130;

class Capabilities130Test extends TestCase
{
    public function testCanCreateInstance()
    {
        $object = new Capabilities130();
        $this->assertInstanceOf(Capabilities130::class, $object);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Type\WMS;

use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Layer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LayerTest extends TestCase
{
    /** @var ValidatorInterface */
    private $validator;

    public function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
    }

    public function testCanCreateInstance(): void
    {
        $object = new Layer();
        $errors = $this->validator->validate($object);
        $this->assertNotEmpty($errors);
    }
}

<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Exception;

use UnexpectedValueException as BaseUnexpectedValueException;
use function sprintf;

class UnexpectedValueException extends BaseUnexpectedValueException
{
    public static function missingProperty(string $element, string $property): self
    {
        return new self(
            sprintf('Missing value for %s attribute of %s', $property, $element)
        );
    }
}

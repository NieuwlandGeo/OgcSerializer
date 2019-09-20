<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer;

use function preg_replace;

/**
 * Some utilities for xml.
 */
class Utils
{
    public static function removeDocType(string $xml): string
    {
        return preg_replace('/<!DOCTYPE[^>]*>/', '', $xml);
    }
}

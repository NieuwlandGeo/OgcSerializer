<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities as WMTSCapabilities;
use RuntimeException;

/**
 * Holds some common used props for OGC services.
 */
class ServiceCapabilitiesFactory
{
    public static function create(object $capabilities): ServiceCapabilities
    {
        if ($capabilities instanceof WMTSCapabilities) {
            return self::createFromWMTS($capabilities);
        }

        throw new RuntimeException('unknown capabilities type');
    }

    private static function createFromWMTS(WMTSCapabilities $capabilities): ServiceCapabilities
    {
        $title = $capabilities->getServiceIdentification()->getTitle();

        $layers = [];
        foreach ($capabilities->getContents()->getLayers() as $layer) {
            $layers[] = new LayerCapabilities($layer->getIdentifier(), $layer->getFormats());
        }

        return new ServiceCapabilities($title, $layers);
    }
}

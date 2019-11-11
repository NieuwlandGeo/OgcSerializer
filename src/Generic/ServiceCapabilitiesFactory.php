<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\Capabilities as WFS11Capabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\OperationsMetadata as OperationsMetadata1;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities as WFS2Capabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\OperationsMetadata as OperationsMetadata2;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Capabilities as WMS13Capabilities;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities as WMTSCapabilities;
use RuntimeException;

class ServiceCapabilitiesFactory
{
    public static function create(object $capabilities): ServiceCapabilities
    {
        if ($capabilities instanceof WMTSCapabilities) {
            return self::createFromWMTS($capabilities);
        }
        if ($capabilities instanceof WMS13Capabilities) {
            return self::createFromWMS13($capabilities);
        }
        if ($capabilities instanceof WFS2Capabilities) {
            return self::createFromWFS2($capabilities);
        }
        if ($capabilities instanceof WFS11Capabilities) {
            return self::createFromWFS11($capabilities);
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

    private static function createFromWMS13(WMS13Capabilities $capabilities): ServiceCapabilities
    {
        $title = $capabilities->getService()->getTitle();

        $layers = [];
        foreach ($capabilities->getLayerNames() as $layername) {
            $layer = $capabilities->getLayer($layername);

            $layers[] = new LayerCapabilities(
                $layer->getName(),
                $layer->getCrsOptions(),
                null,
                $capabilities->getCapability()->getRequest()->getGetMap()->getFormat(),
                $capabilities->getCapability()->getRequest()->getGetFeatureInfo()->getFormat()
            );
        }

        return new ServiceCapabilities($title, $layers);
    }

    private static function createFromWFS2(WFS2Capabilities $capabilities): ServiceCapabilities
    {
        $title  = $capabilities->getServiceIdentification()->getTitle();
        $layers = [];
        /** @var OperationsMetadata2 $meta */
        $meta    = $capabilities->getOperationsMetadata();
        $formats = [];
        $param   = $meta->getOperation('GetFeature')->getParameter('outputFormat');
        $formats = $param->getAllowedValues()->getValues();

        foreach ($capabilities->getFeatureTypeList()->getFeatureTypes() as $featureType) {
            $layers[] = new LayerCapabilities(
                $featureType->getName(),
                $featureType->getCrsOptions(),
                $featureType->getDefaultCrs(),
                $formats
            );
        }

        return new ServiceCapabilities($title, $layers);
    }

    private static function createFromWFS11(WFS11Capabilities $capabilities): ServiceCapabilities
    {
        $title  = $capabilities->getServiceIdentification()->getTitle();
        $layers = [];
        /** @var OperationsMetadata1 $meta */
        $meta    = $capabilities->getOperationsMetadata();
        $formats = [];
        $param   = $meta->getOperation('GetFeature')->getParameter('outputFormat');
        $formats = $param->getValues();

        foreach ($capabilities->getFeatureTypeList()->getFeatureTypes() as $featureType) {
            $layers[] = new LayerCapabilities(
                $featureType->getName(),
                $featureType->getCrsOptions(),
                $featureType->getDefaultCrs(),
                $formats
            );
        }

        return new ServiceCapabilities($title, $layers);
    }
}

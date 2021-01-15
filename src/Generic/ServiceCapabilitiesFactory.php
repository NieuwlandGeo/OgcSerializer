<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Generic\Transformer\WFS2Transformer;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\Capabilities as WFS11Capabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\OperationsMetadata as OperationsMetadata1;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities as WFS2Capabilities;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Capabilities as WMS13Capabilities;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities as WMTSCapabilities;
use RuntimeException;

class ServiceCapabilitiesFactory
{
    public static function create(object $capabilities): ServiceCapabilitiesInterface
    {
        if ($capabilities instanceof ServiceCapabilitiesInterface) {
            return $capabilities;
        }

        if ($capabilities instanceof WMTSCapabilities) {
            return self::createFromWMTS($capabilities);
        }

        if ($capabilities instanceof WMS13Capabilities) {
            return self::createFromWMS13($capabilities);
        }

        if ($capabilities instanceof WFS2Capabilities) {
            $transfomer = new WFS2Transformer();

            return $transfomer->transform($capabilities);
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
            $projections = [];
            foreach ($layer->getTileMatrixSetLinks() as $link) {
                $layerTilesetId = $link->getTileMatrixSet();
                $projections[]  = $capabilities->getContents()->getTileMatrixSet($layerTilesetId)->getSupportedCRS();
            }

            $layers[] = new LayerCapabilities(
                $layer->getIdentifier(),
                $projections,
                $layer->getTitle(),
                null,
                $layer->getFormats()
            );
        }

        return new ServiceCapabilities($title, $layers, [$capabilities->getVersion()]);
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
                $layer->getTitle(),
                null,
                $capabilities->getCapability()->getRequest()->getGetMap()->getFormat(),
                $capabilities->getCapability()->getRequest()->getGetFeatureInfo()->getFormat()
            );
        }

        return new ServiceCapabilities($title, $layers, [$capabilities->getVersion()]);
    }

    private static function createFromWFS11(WFS11Capabilities $capabilities): ServiceCapabilities
    {
        $title  = $capabilities->getServiceIdentification()->getTitle();
        $layers = [];
        /** @var OperationsMetadata1 $meta */
        $meta     = $capabilities->getOperationsMetadata();
        $formats  = [];
        $param    = $meta->getOperation('GetFeature')->getParameter('outputFormat');
        $formats  = $param->getValues();
        $versions = $meta
            ->getOperation('GetCapabilities')
            ->getParameter('AcceptVersions')
            ->getValues();

        foreach ($capabilities->getFeatureTypeList()->getFeatureTypes() as $featureType) {
            $layers[] = new LayerCapabilities(
                $featureType->getName(),
                $featureType->getCrsOptions(),
                $featureType->getTitle(),
                $featureType->getDefaultCrs(),
                $formats
            );
        }

        return new ServiceCapabilities($title, $layers, $versions);
    }
}

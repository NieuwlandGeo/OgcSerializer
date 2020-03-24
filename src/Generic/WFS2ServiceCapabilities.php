<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use InvalidArgumentException;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities as WFS2Capabilities;
use function array_keys;

/**
 * Adapter for WFS2.
 */
class WFS2ServiceCapabilities implements ServiceCapabilitiesInterface
{
    /** @var WFS2Capabilities */
    private $capabilities;
    /** @var LayerCapabilities[] */
    private $layers;

    public function __construct(WFS2Capabilities $capabilities)
    {
        $this->capabilities = $capabilities;

        /** @var OperationsMetadata2 $meta */
        $meta    = $capabilities->getOperationsMetadata();
        $formats = [];
        $param   = $meta->getOperation('GetFeature')->getParameter('outputFormat');
        $formats = $param->getAllowedValues()->getValues();
        foreach ($capabilities->getFeatureTypeList()->getFeatureTypes() as $featureType) {
            $this->layers[$featureType->getName()] = new LayerCapabilities(
                $featureType->getName(),
                $featureType->getCrsOptions(),
                $featureType->getTitle(),
                $featureType->getDefaultCrs(),
                $formats
            );
        }
    }

    public function getTitle(): string
    {
        return $this->capabilities->getServiceIdentification()->getTitle();
    }

    public function hasLayer(string $name): bool
    {
        return isset($this->layers[$name]);
    }

    public function getLayer(string $name): LayerCapabilitiesInterface
    {
        if (false === $this->hasLayer($name)) {
            throw new InvalidArgumentException('unknown layer name');
        }

        return $this->layers[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        return array_keys($this->layers);
    }

    /**
     * {@inheritdoc}
     */
    public function getVersions(): array
    {
        /** @var OperationsMetadata2 $meta */
        $meta = $this->capabilities->getOperationsMetadata();

        return $meta
            ->getOperation('GetCapabilities')
            ->getParameter('AcceptVersions')
            ->getAllowedValues()
            ->getValues();
    }
}

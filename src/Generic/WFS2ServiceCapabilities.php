<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use InvalidArgumentException;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities as WFS2Capabilities;
use function array_filter;
use function array_keys;
use function array_values;

/**
 * Adapter for WFS2.
 */
class WFS2ServiceCapabilities implements ServiceCapabilitiesInterface
{
    /** @var LayerCapabilities[] */
    private $layers;
    /** @var string */
    private $title;
    /** @var string[] */
    private $versions;

    public function __construct(WFS2Capabilities $capabilities)
    {
        // set title
        $this->title = $capabilities->getServiceIdentification()->getTitle();
        /** @var OperationsMetadata2 $meta */
        $meta = $capabilities->getOperationsMetadata();
        //set versions
        $origVersions = $meta
            ->getOperation('GetCapabilities')
            ->getParameter('AcceptVersions')
            ->getAllowedValues()
            ->getValues();

        $this->versions = array_values(
            array_filter($origVersions, static function ($v) {
                return '1.0.0' !== $v;
            })
        );

        //set layers
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
        return $this->title;
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
        return $this->versions;
    }
}

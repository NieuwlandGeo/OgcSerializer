<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic\Transformer;

use Nieuwland\OgcSerializer\Generic\LayerCapabilities;
use Nieuwland\OgcSerializer\Generic\ServiceCapabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\FeatureTypeList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\OperationsMetadata;
use function array_filter;
use function array_values;

class WFS2Transformer implements TransformerInterface
{
    /**
     * {@inheritdoc}
     *
     * @param Capabilities $data
     */
    public function transform($data): ServiceCapabilities
    {
        $title    = $data->getServiceIdentification()->getTitle();
        $versions = [];

        /** @var OperationsMetadata $meta */
        $meta           = $data->getOperationsMetadata();
        $acceptVersions = $meta
            ->getOperation('GetCapabilities')
            ->getParameter('AcceptVersions');
        if ($acceptVersions) {
            $versions = array_values(
                array_filter(
                    $acceptVersions->getAllowedValues()->getValues(),
                    static function ($v) {
                        return '1.0.0' !== $v;
                    }
                )
            );
        }
        $formats                = [];
        $getFeatureOperation    = $meta->getOperation('GetFeature');
        $getFeatureOutputFormat = $getFeatureOperation->getParameter('outputFormat');
        if ($getFeatureOutputFormat) {
            $formats = $getFeatureOutputFormat->getAllowedValues()->getValues();
        }
        $layers = $this->findLayers($data->getFeatureTypeList(), $formats);

        return new ServiceCapabilities(
            $title,
            $layers,
            $versions
        );
    }

    /**
     * @param string[] $formats
     *
     * @return LayerCapabilities[]
     */
    private function findLayers(FeatureTypeList $featureTypeList, array $formats): array
    {
        $layers = [];

        foreach ($featureTypeList->getFeatureTypes() as $featureType) {
            $layers[] = new LayerCapabilities(
                $featureType->getName(),
                $featureType->getCrsOptions(),
                $featureType->getTitle(),
                $featureType->getDefaultCrs(),
                $formats
            );
        }

        return $layers;
    }
}

<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use OgcSerializer\Type\LayerCollectionInterface;
use OgcSerializer\Type\LayerInterface;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wfs/2.0")
 * @XmlRoot("WFS_Capabilities")
 */
abstract class AbstractCapabilities implements LayerCollectionInterface
{
    /**
     * @Type("OgcSerializer\Type\WFS\Capabilities\FeatureTypeList")
     *
     * @var FeatureTypeList
     */
    private $featureTypeList;

    /**
     * Get the value of featureTypeList.
     *
     * @return FeatureTypeList
     */
    public function getFeatureTypeList()
    {
        return $this->featureTypeList;
    }

    /**
     * Set the value of featureTypeList.
     *
     * @param FeatureTypeList $featureTypeList
     *
     * @return self
     */
    public function setFeatureTypeList(FeatureTypeList $featureTypeList)
    {
        $this->featureTypeList = $featureTypeList;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getLayer(string $name): LayerInterface
    {
        return;
    }
}

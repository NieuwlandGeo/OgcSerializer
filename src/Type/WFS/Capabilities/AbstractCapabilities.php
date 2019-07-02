<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WFS\Capabilities;

use function array_keys;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use OgcSerializer\Type\LayerCollectionInterface;
use OgcSerializer\Type\LayerInterface;
use RuntimeException;
use function sprintf;

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

    public function getLayerNames(): array
    {
        return array_keys($this->getFeatureTypeList()->getFeatureTypes());
    }

    public function getLayer(string $name): LayerInterface
    {
        $types = $this->getFeatureTypeList()->getFeatureTypes();

        if (!isset($types[$name])) {
            throw new RuntimeException(sprintf('Featuretype %s not found', $name));
        }

        return $types[$name];
    }
}

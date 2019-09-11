<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use Nieuwland\OgcSerializer\Type\LayerCollectionInterface;
use Nieuwland\OgcSerializer\Type\LayerInterface;
use RuntimeException;
use function array_keys;
use function sprintf;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wfs/2.0")
 * @XmlRoot("WFS_Capabilities")
 */
abstract class AbstractCapabilities implements LayerCollectionInterface
{
    /**
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    private $version;

    /**
     * featuretypelist.
     *
     * @var AbstractFeatureTypeList
     */
    protected $featureTypeList;

    /**
     * @return AbstractFeatureTypeList
     */
    abstract public function getFeatureTypeList(): AbstractFeatureTypeList;

    public function getLayerNames(): array
    {
        return array_keys($this->getFeatureTypeList()->getFeatureTypes());
    }

    public function getLayer(string $name): LayerInterface
    {
        $types = $this->getFeatureTypeList()->getFeatureTypes();

        if (! isset($types[$name])) {
            throw new RuntimeException(sprintf('Featuretype %s not found', $name));
        }

        return $types[$name];
    }

    public function getFeatureType(string $name): AbstractFeatureType
    {
        return $this->getLayer($name);
    }

    /**
     * Get the value of version.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}

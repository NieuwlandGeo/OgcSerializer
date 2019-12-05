<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

use InvalidArgumentException;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use Nieuwland\OgcSerializer\Type\LayerCollectionInterface;
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
     * @SerializedName("version")
     *
     * @var string
     */
    protected $version;

    /** @var AbstractFeatureTypeList */
    protected $featureTypeList;

    /** @var AbstractServiceIdentification */
    protected $serviceIdentification;

    /** @var AbstractOperationsMetadata */
    protected $operationsMetadata;

    public function getFeatureTypeList(): AbstractFeatureTypeList
    {
        return $this->featureTypeList;
    }

    public function getServiceIdentification(): AbstractServiceIdentification
    {
        return $this->serviceIdentification;
    }

    public function getOperationsMetadata(): AbstractOperationsMetadata
    {
        return $this->operationsMetadata;
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        return array_keys($this->getFeatureTypeList()->getFeatureTypes());
    }

    /**
     * {@inheritdoc}
     */
    public function getLayer(string $name)
    {
        $types = $this->getFeatureTypeList()->getFeatureTypes();

        if (! isset($types[$name])) {
            throw new InvalidArgumentException(sprintf('Featuretype %s not found', $name));
        }

        return $types[$name];
    }

    public function getFeatureType(string $name): AbstractFeatureType
    {
        return $this->getLayer($name);
    }

    /**
     * Get the value of version.
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Set the value of version.
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}

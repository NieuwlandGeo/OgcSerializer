<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use Nieuwland\OgcSerializer\Type\LayerCollectionInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wms")
 */
class Capabilities implements LayerCollectionInterface
{
    /**
     * @XmlAttribute
     * @Type("string")
     * @SerializedName("version")
     *
     * @var string
     */
    protected $version;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Service")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var Service
     *
     * @Assert\NotNull
     */
    private $service;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Capability")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var Capability
     *
     * @Assert\NotNull
     */
    private $capability;

    /**
     * Get the value of service.
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * Set the value of service.
     */
    public function setService(Service $service): self
    {
        $this->service = $service;

        return $this;
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

    /**
     * Get the value of capability.
     */
    public function getCapability(): Capability
    {
        return $this->capability;
    }

    /**
     * Set the value of capability.
     */
    public function setCapability(Capability $capability): self
    {
        $this->capability = $capability;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        $parentLayer = $this->getCapability()->getLayer();
        $names       = $parentLayer->getLayerNames();
        if ($parentLayer->getName()) {
            $names[] = $parentLayer->getName();
        }

        return $names;
    }

    public function getLayer(string $name): Layer
    {
        return $this->getCapability()->getLayer()->getLayerByName($name);
    }
}

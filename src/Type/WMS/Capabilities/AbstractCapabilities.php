<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use Nieuwland\OgcSerializer\Type\LayerCollectionInterface;
use RuntimeException;
use function sprintf;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wms")
 */
abstract class AbstractCapabilities implements LayerCollectionInterface
{
    /**
     * @XmlAttribute
     * @Type("string")
     *
     * @var string
     */
    protected $version;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\Service")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var Service
     */
    private $service;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\Capability")
     *
     * @var Capability
     */
    private $capability;

    /**
     * Get the value of service.
     *
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * Set the value of service.
     *
     * @param Service $service
     *
     * @return self
     */
    public function setService(Service $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the value of version.
     *
     * @param string $version
     *
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the value of capability.
     *
     * @return Capability
     */
    public function getCapability(): Capability
    {
        return $this->capability;
    }

    /**
     * Set the value of capability.
     *
     * @param Capability $capability
     *
     * @return self
     */
    public function setCapability(Capability $capability)
    {
        $this->capability = $capability;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        $defaultLayerName = $this->getCapability()->getLayer()->getName();
        $names            = $defaultLayerName ? [$defaultLayerName] : [];

        foreach ($this->getCapability()->getLayer()->getLayers() as $layer) {
            $names[] = $layer->getName();
        }

        return $names;
    }

    public function getLayer(string $name): Layer
    {
        if ($name === $this->getCapability()->getLayer()->getName()) {
            return $this->getCapability()->getLayer();
        }
        foreach ($this->getCapability()->getLayer()->getLayers() as $layer) {
            if ($layer->getName() === $name) {
                return $layer;
            }
        }
        throw new RuntimeException(sprintf('Layer %s not found', $name));
    }
}

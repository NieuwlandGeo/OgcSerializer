<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use Nieuwland\OgcSerializer\Type\LayerCollectionInterface;
use function array_keys;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wmts/1.0")
 */
class Capabilities implements LayerCollectionInterface
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Contents")
     *
     * @var Contents
     */
    protected $contents;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\ServiceIdentification")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var ServiceIdentification
     */
    protected $serviceIdentification;

    /**
     * @XmlAttribute
     * @Type("string")
     * @SerializedName("version")
     *
     * @var string
     */
    protected $version;

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        return array_keys($this->contents->getLayers());
    }

    public function getLayer(string $name): ?Layer
    {
        $layers = $this->contents->getLayers();

        return $layers[$name];
    }

    public function getContents(): Contents
    {
        return $this->contents;
    }

    public function getServiceIdentification(): ServiceIdentification
    {
        return $this->serviceIdentification;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}

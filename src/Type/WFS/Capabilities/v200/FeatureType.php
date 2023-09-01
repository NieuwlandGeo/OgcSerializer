<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractFeatureType;

use function count;

class FeatureType extends AbstractFeatureType
{
    /**
     * @Type("string")
     * @SerializedName("DefaultCRS")
     *
     * @var string
     */
    protected $defaultCRS;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="OtherCRS")
     *
     * @var string[]
     */
    protected $otherCRS;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\MetadataURL>")
     * @XmlList(inline=true, entry="MetadataURL")
     *
     * @var MetadataURL[]
     */
    private $metadataURLs;

    public function getDefaultCRS(): string
    {
        return $this->defaultCRS;
    }

    /**
     * Set the value of defaultCRS.
     */
    public function setDefaultCRS(string $defaultCRS): self
    {
        $this->defaultCRS = $defaultCRS;

        return $this;
    }

    /**
     * Get the value of otherCRS.
     *
     * @return string[]
     */
    public function getOtherCRS(): array
    {
        return $this->otherCRS;
    }

    /**
     * Set the value of otherCRS.
     *
     * @param stinrg[] $otherCRS
     */
    public function setOtherCRS(array $otherCRS): self
    {
        $this->otherCRS = $otherCRS;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCrsOptions(): array
    {
        $crs   = $this->getOtherCRS();
        $crs[] = $this->getDefaultCRS();

        return $crs;
    }

    /**
     * @return MetadataURL[]
     */
    public function getMetadataURLs(): array
    {
        return $this->metadataURLs;
    }

    /**
     * @param MetadataURL[] $metadataURLs
     */
    public function setMetadataURLs(array $metadataURLs): self
    {
        $this->metadataURLs = $metadataURLs;

        return $this;
    }

    public function getMetadataURL(): ?string
    {
        if (0 === count($this->metadataURLs)) {
            return null;
        }

        return $this->metadataURLs[0]->getHref();
    }
}

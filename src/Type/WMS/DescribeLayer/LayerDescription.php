<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\DescribeLayer;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

class LayerDescription
{
    /**
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("name")
     *
     * @var string
     */
    private $name;

    /**
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("wfs")
     *
     * @var string
     */
    private $wfs;

    /**
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("owsType")
     *
     * @var string
     */
    private $owsType;

    /**
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("owsURL")
     *
     * @var string
     */
    private $owsURL;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\DescribeLayer\Query")
     *
     * @var Query
     */
    private $query;

    /**
     * Get the value of name.
     *
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     *
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of wfs.
     *
     */
    public function getWfs(): string
    {
        return $this->wfs;
    }

    /**
     * Set the value of wfs.
     *
     *
     */
    public function setWfs(string $wfs): self
    {
        $this->wfs = $wfs;

        return $this;
    }

    /**
     * Get the value of owsType.
     *
     */
    public function getOwsType(): string
    {
        return $this->owsType;
    }

    /**
     * Set the value of owsType.
     *
     *
     */
    public function setOwsType(string $owsType): self
    {
        $this->owsType = $owsType;

        return $this;
    }

    /**
     * Get the value of owsURL.
     *
     */
    public function getOwsURL(): string
    {
        return $this->owsURL;
    }

    /**
     * Set the value of owsURL.
     *
     *
     */
    public function setOwsURL(string $owsURL): self
    {
        $this->owsURL = $owsURL;

        return $this;
    }

    /**
     * Get the value of query.
     *
     */
    public function getQuery(): Query
    {
        return $this->query;
    }

    /**
     * Set the value of query.
     *
     *
     */
    public function setQuery(Query $query): self
    {
        $this->query = $query;

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WMS\DescribeLayer;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

class LayerDescription
{
    /**
     * @Type("string")
     * @XmlAttribute()
     *
     * @var string
     */
    private $name;

    /**
     * @Type("string")
     * @XmlAttribute()
     *
     * @var string
     */
    private $wfs;

    /**
     * @Type("string")
     * @XmlAttribute()
     *
     * @var string
     */
    private $owsType;

    /**
     * @Type("string")
     * @XmlAttribute()
     *
     * @var string
     */
    private $owsURL;

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string $name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of wfs
     *
     * @return  string
     */
    public function getWfs()
    {
        return $this->wfs;
    }

    /**
     * Set the value of wfs
     *
     * @param  string $wfs
     *
     * @return  self
     */
    public function setWfs(string $wfs)
    {
        $this->wfs = $wfs;

        return $this;
    }

    /**
     * Get the value of owsType
     *
     * @return  string
     */
    public function getOwsType()
    {
        return $this->owsType;
    }

    /**
     * Set the value of owsType
     *
     * @param  string $owsType
     *
     * @return  self
     */
    public function setOwsType(string $owsType)
    {
        $this->owsType = $owsType;

        return $this;
    }

    /**
     * Get the value of owsURL
     *
     * @return  string
     */
    public function getOwsURL()
    {
        return $this->owsURL;
    }

    /**
     * Set the value of owsURL
     *
     * @param  string $owsURL
     *
     * @return  self
     */
    public function setOwsURL(string $owsURL)
    {
        $this->owsURL = $owsURL;

        return $this;
    }
}

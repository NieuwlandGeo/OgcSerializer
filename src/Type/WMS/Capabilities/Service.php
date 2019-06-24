<?php

namespace OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;

use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @XmlRoot("Service")
 */
class Service
{
    /**
     * @var string
     *
     * @Type("string")
     * @SerializedName("Name")
     * @XmlElement(cdata=false)
     */
    private $name;
    /**
     * @var string
     *
     * @Type("string")
     */
    private $title;
    
    /**
     * @var string
     *
     * @Type("string")
     */
    private $abstract;


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
     * @param  string  $name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of abstract
     *
     * @return  string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set the value of abstract
     *
     * @param  string  $abstract
     *
     * @return  self
     */
    public function setAbstract(string $abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }
}
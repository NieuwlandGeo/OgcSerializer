<?php

namespace OgcClient\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\SerializedName;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wms")
 */
abstract class AbstractCapabilities
{
    /**
     * @var string
     *
     * @Type("string")
     * @XmlAttribute
     */
    protected $version;

    /**
     * @Type("OgcClient\Type\WMS\Capabilities\Service")
     *
     * @XmlElement(namespace="http://www.opengis.net/wms")
     * @SerializedName("Service")
     *
     * @var Service
     */
    private $service;

    /**
     * Get the value of service
     *
     * @return  Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @param  Service  $service
     *
     * @return  self
     */
    public function setService(Service $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of version
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the value of version
     *
     * @param  string  $version
     *
     * @return  self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }
}

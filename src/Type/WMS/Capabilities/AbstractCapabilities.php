<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wms")
 */
abstract class AbstractCapabilities
{
    /**
     * @XmlAttribute
     * @Type("string")
     *
     * @var string
     */
    protected $version;

    /**
     * @SerializedName("Service")
     * @Type("OgcSerializer\Type\WMS\Capabilities\Service")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var Service
     */
    private $service;

    /**
     * Get the value of service
     *
     * @return  Service
     */
    public function getService() : Service
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @param  Service $service
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
     * @param   string $version
     *
     * @return  self
     */
    public function setVersion(string $version) : self
    {
        $this->version = $version;

        return $this;
    }
}

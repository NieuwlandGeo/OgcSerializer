# Ogc Serializer

[![Build Status](https://travis-ci.org/NieuwlandGeo/OgcSerializer.svg?branch=master)](https://travis-ci.org/NieuwlandGeo/OgcSerializer)

Read documents from OGC (Open Geospatial Consortium) web service interfaces. Similar to [OWSLib](https://geopython.github.io/OWSLib/) but without a http client.

Supports:

* WMS 1.3.0 capabilities
* WFS 2.0.0 and 1.1.0 capabilities
* WMTS 1.0 capabilities
* Reading WFS schema from describefeaturetype request

Planned:

* OGC feature api

## Install

```
composer require nieuwland/ogc-serializer
```


## Planned

*This package is in development!*

(de)Serialize WMS, WFS and WMTS getCapabilities and related.

## Example

### Reading capabilities

```php
<?php

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Capabilities130;

$serializer   = SerializerFactory::create();
/** @var Capabilities130 $capabilities */
$capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
$layer = $capabilities->getLayer('mylayer');
```

### extracting common used props

The project has some objects for easy data transfer to clients unaware of differences between the protocols.

```php
<?php

use Nieuwland\OgcSerializer\Generic\ServiceCapabilitiesFactory;
use Nieuwland\OgcSerializer\SerializerFactory;

$serializer   = SerializerFactory::create();
/** @var Capabilities130 $capabilities */
$capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
$genericCapabilities = ServiceCapabilitiesFactory::create($capabilities);
$genericCapabilities->getLayerNames();

```


### WFS schema

```php
<?php

use Nieuwland\OgcSerializer\Utils\WfsSchemaElement;

$reader = new WfsSchemaReader()
$fields = $reader->extractFields($xml, 'bestuurlijkegrenzen:gemeenten');
foreach ($fields as $field) {
    echo $field->getName() . $field->getType();
}
```

## Contribute

* Follow the coding standards defined in `phpcs.xml.dist`
* Add tests for your code
 
## Professional Support

For eventual paid support please write an email to develop@nieuwland.nl.

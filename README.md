# Ogc Serializer

Read documents from OGC (Open Geospatial Consortium) web service interfaces. Similar to [OWSLib](https://geopython.github.io/OWSLib/) but without a http client.

## Planned

*This package is in early development!*

(de)Serialize WMS, WFS and WMTS getCapabilities and related.

## Example

```php
<?php

use Nieuwland\OgcSerializer\SerializerFactory;
use Nieuwland\OgcSerializer\Type\WMS\Capabilities\Capabilities130;

$serializer   = SerializerFactory::create();
/** @var LayerCollectionInterface $capabilities */
$capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
/** @var LayerInterface $layer */
$layer = $capabilities->getLayer('mylayer');
```


## Contribute

* Follow the coding standards defined in `phpcs.xml.dist`
* Add tests for your code
 
## Professional Support

For eventual paid support please write an email to develop@nieuwland.nl.
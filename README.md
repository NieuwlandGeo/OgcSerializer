# Ogc Serializer


## Planned

* (de)serialize WMS, WFS and WMTS getCapabilities and related

## Example

```php
<?php

use OgcSerializer\SerializerFactory;
use OgcSerializer\Type\WMS\Capabilities\Capabilities130;

$serializer   = SerializerFactory::create();
/** @var LayerCollectionInterface $capabilities */
$capabilities = $serializer->deserialize($xml, Capabilities130::class, 'xml');
/** @var LayerInterface $layer */
$layer = $capabilities->getLayer('mylayer');
```


## TODO 

* Implement WMTS capabilities.
* CI 

## Contribute

* Follow the coding standards defined in `phpcs.xml.dist`
* Add tests for your code
 
## Professional Support

For eventual paid support please write an email to develop@nieuwland.nl.
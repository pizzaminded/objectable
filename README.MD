# pizzaminded/objectable

Turn your array of objects into html table or whatever you want to by using ``doctrine/annotations``.

Inspired by [My Old Bundle](https://github.com/pizzaminded/EntableBundle). 

PHP 7.3 required.

## Annotations Reference

### Objectable\ActionField

Adds action field 

### Objectable\Header

Defines a field which will be rendered and sets the column name for them.




#### Example:


````php
<?php 

use Pizzaminded\Objectable\Annotation as Objectable;

class Person {

    /**
     * @Objectable\Header(title="First Name") 
     * @var string
     */
    public $firstName;

}

````

Will be rendered as:


|First Name|
|---|
|Mickey|
|Mike|
|Michael|



## Value Transformers

Allows to modify rendered content.

### Custom Header Transformer


````php
<?php

class UpperCaseTransformer implements \Pizzaminded\Objectable\Transformer\HeaderTransformerInterface {
    pubf
}


/** @var \Pizzaminded\Objectable\Objectable $objectable */
$objectable->

````

### Custom Action Field Transformer



## Tests

``
vendor/bin/phpunit
``

## License

MIT, see LICENSE file for more
# pizzaminded/objectable

Turn your array of objects into html table or whatever you want to by using ``doctrine/annotations``. Twig Extension included. Inspired by [My Old Bundle](https://github.com/pizzaminded/EntableBundle). 

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
    
    /**
     * @param string $title
     * @param string $className
     * @param string $propertyName
     * @return string
     */
    public function transform(string $title, string $className, string $propertyName): string
    {
        return \strtoupper($title);
    }
}


/** @var \Pizzaminded\Objectable\Objectable $objectable */
$objectable->setHeaderTransformer(new UpperCaseTransformer());

````

### Custom Action Field Transformer

@TODO

### Things that need to be done before ``1.0.0`` release:

- [ ] Odd\Even Rows
- [ ] Action Fields
- [ ] Tests
- [ ] Custom Template Renderers

## Tests

@TODO

## License

MIT, see LICENSE file for more

<?php

namespace Pizzaminded\Objectable\Transformer;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface HeaderTransformerInterface
{

    /**
     * @param string $title
     * @param string $className
     * @param string $propertyName
     * @return string
     */
    public function transform(string $title, string $className, string $propertyName): string;

}
<?php

namespace Pizzaminded\Objectable\Transformer;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ValueTransformerInterface
{
    /**
     * @param mixed $value any value got from object
     * @param string $className
     * @param string $propertyName
     * @param bool $stopPropagation
     * @return string
     */
    public function transform($value, string $className, string $propertyName, bool &$stopPropagation): string;
}
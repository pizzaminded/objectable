<?php

namespace Pizzaminded\Objectable\Transformer;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ActionFieldTransformerInterface
{
    /**
     * @param string|object $value Object or value of property passed in ActionField#property annotation
     * @param string $fieldName value passed in ActionField#name property
     * @param string $fieldPath value passed in Action
     * @param string|null $propertyName Property passed in $value argument (if empty - whole object passed)
     * @return string
     */
    public function transformActionUrl($value, string $fieldName, string $fieldPath, ?string $propertyName): string;

    /**
     * @param string $fieldLabel
     * @param string $fieldName
     * @return string
     */
    public function transformActionLabel(string $fieldLabel, string $fieldName/**, string $fieldPath **/): string;
}
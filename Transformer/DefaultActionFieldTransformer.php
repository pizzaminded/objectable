<?php

namespace Pizzaminded\Objectable\Transformer;

use Pizzaminded\Objectable\ObjectableException;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DefaultActionFieldTransformer implements ActionFieldTransformerInterface
{

    /**
     * {@inheritdoc}
     */
    public function transformActionUrl($value, string $fieldName, string $fieldPath, ?string $propertyName): string
    {
        if($propertyName === null) {
            throw new ObjectableException('Please provide "name" attribute for "'.$fieldName.'" action field.');
        }

        return $fieldPath.'?'.$propertyName.'='.$value;
    }

    /**
     * {@inheritdoc}
     */
    public function transformActionLabel(string $fieldLabel, string $fieldName/**, string $fieldPath **/): string
    {
        return $fieldLabel;
    }
}
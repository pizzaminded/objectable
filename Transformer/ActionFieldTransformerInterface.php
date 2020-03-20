<?php

namespace Pizzaminded\Objectable\Transformer;

use Pizzaminded\Objectable\Annotation\ActionField;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ActionFieldTransformerInterface
{
    /**
     * @param ActionField $actionField Annotation taken from given entity
     * @return string
     */
    public function transformActionUrl(ActionField $actionField): string;
}
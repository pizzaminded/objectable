<?php

namespace Pizzaminded\Objectable;

use Pizzaminded\Objectable\Annotation\ActionField;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ResultRow
{
    /**
     * @var ActionField[]
     */
    protected $actionFields = [];

    /**
     * @var array<string, string>
     */
    protected $values = [];
}
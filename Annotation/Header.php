<?php

namespace Pizzaminded\Objectable\Annotation;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 *
 * @TODO: add some constructor
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Header
{
    /**
     * @Required
     * @var string
     */
    public $title;

    /**
     * @Required
     * @var int
     */
    public $order;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }


}
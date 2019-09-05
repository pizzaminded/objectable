<?php

namespace Pizzaminded\Objectable\Annotation;

/**
 * @Annotation
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Header
{
    /**
     * @var string|null
     */
    protected $title;

    /**
     * @var int|null
     */
    protected $order;

    /**
     * Header constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->title = $values['title'] ?? null;
        $this->order = $values['order'] ?? null;
    }

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
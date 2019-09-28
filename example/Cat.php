<?php

use Pizzaminded\Objectable\Annotation as Objectable;

/**
 * @Objectable\Row()
 */
class Cat
{

    /**
     * @Objectable\Header(title="Cat name", order=2)
     * @var string
     */
    protected $name;

    /**
     * @Objectable\Header(order=3, title="Cat colour")
     * @var string
     */
    protected $colour;

    /**
     * @Objectable\Header(title="ID", order=1)
     * @var int
     */
    protected $id;

    /**
     * Cat constructor.
     * @param int $id
     * @param string $colour
     * @param string $name
     */
    public function __construct(int $id, string $colour, string $name)
    {
        $this->id = $id;
        $this->colour = $colour;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColour(): string
    {
        return $this->colour;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}
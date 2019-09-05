<?php

namespace Pizzaminded\Objectable\Twig\Extension;

use Pizzaminded\Objectable\Objectable;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ObjectableExtension extends AbstractExtension
{

    /**
     * @var Objectable
     */
    protected $objectable;

    /**
     * ObjectableExtension constructor.
     * @param Objectable $objectable
     */
    public function __construct(Objectable $objectable)
    {
        $this->objectable = $objectable;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('objectable', [$this, 'renderTable']),
        ];
    }

    /**
     * @param array $data
     * @return string
     */
    public function renderTable(array $data): string
    {

    }
}
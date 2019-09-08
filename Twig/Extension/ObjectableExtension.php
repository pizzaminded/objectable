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
            new TwigFunction('objectable', [$this, 'renderTable'], ['is_safe' => ['html']]),
            new TwigFunction('objectable_single', [$this, 'renderSingle'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param array $data
     * @return string
     * @throws \Pizzaminded\Objectable\ObjectableException
     * @throws \ReflectionException
     */
    public function renderTable($data): string
    {
        return $this->objectable->renderTable($data);
    }

    /**
     * @param object $data
     * @return string
     */
    public function renderSingle($data): string
    {
        return $this->objectable->renderSingleObject($data);
    }
}
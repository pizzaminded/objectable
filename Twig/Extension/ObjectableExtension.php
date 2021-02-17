<?php
declare(strict_types=1);

namespace Pizzaminded\Objectable\Twig\Extension;

use Pizzaminded\Objectable\Objectable;
use Pizzaminded\Objectable\ObjectableException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ObjectableExtension extends AbstractExtension
{

    /**
     * @var Objectable
     */
    protected Objectable $objectable;

    public function __construct(Objectable $objectable)
    {
        $this->objectable = $objectable;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('objectable', [$this, 'renderTable'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param array|\Iterator $data
     * @return string
     * @throws ObjectableException
     * @throws \ReflectionException
     */
    public function renderTable(array|\Iterator $data): string
    {
        return $this->objectable->renderTable($data);
    }

}
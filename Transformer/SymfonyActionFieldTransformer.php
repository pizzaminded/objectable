<?php

namespace Pizzaminded\Objectable\Transformer;

use Pizzaminded\Objectable\Annotation\ActionField;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Bridges Objectable Action Fields with Symfony Router and Translator.
 *
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SymfonyActionFieldTransformer implements ActionFieldTransformerInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;


    /**
     * SymfonyActionFieldTransformer constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param ActionField $actionField Annotation taken from given entity
     * @return string
     */
    public function transformActionUrl(ActionField $actionField): string
    {
        // TODO: Implement transformActionUrl() method.
    }
}
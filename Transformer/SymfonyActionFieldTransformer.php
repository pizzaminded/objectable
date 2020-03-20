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
    protected UrlGeneratorInterface $urlGenerator;

    /**
     * @var PropertyAccessor
     */
    protected PropertyAccessor $propertyAccessor;

    /**
     * SymfonyActionFieldTransformer constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * @param ActionField $actionField Annotation taken from given entity
     * @param object $entity
     * @return string
     */
    public function transformActionUrl(ActionField $actionField, object $entity): string
    {
        //Take a value from given property
        $propertyValue = $this->propertyAccessor->getValue($entity, $actionField->property);

        //Generate url
        return $this->urlGenerator->generate(
            $actionField->path,
            [
                $actionField->key => $propertyValue
            ]
        );
    }
}
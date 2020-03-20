<?php
declare(strict_types=1);

namespace Pizzaminded\Objectable\Transformer;

use Pizzaminded\Objectable\Annotation\ActionField;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

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
     * @var TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * @var PropertyAccessor
     */
    protected PropertyAccessor $propertyAccessor;

    /**
     * SymfonyActionFieldTransformer constructor.
     * @param UrlGeneratorInterface $urlGenerator
     * @param TranslatorInterface $translator
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        TranslatorInterface $translator
    )
    {
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
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

    /**
     * Allows to transform given label in user-defined way.
     * @param ActionField $actionField Annotation taken from given entity
     * @param object $entity Currently processed entity
     * @return string
     */
    public function transformActionLabel(ActionField $actionField, object $entity): string
    {
        return $this->translator->trans($actionField->label);
    }
}
<?php

namespace Pizzaminded\Objectable\Transformer;

use Pizzaminded\Objectable\ObjectableException;
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
    protected $urlGenerator;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * SymfonyActionFieldTransformer constructor.
     * @param UrlGeneratorInterface $urlGenerator
     * @param TranslatorInterface $translator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, TranslatorInterface $translator)
    {
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     * @throws ObjectableException
     */
    public function transformActionUrl($value, string $fieldName, string $fieldPath, ?string $propertyName): string
    {
        if ($propertyName === null || !is_scalar($value)) {
            throw new ObjectableException('Please provide a scalar property for "' . $fieldName . '" action');
        }

        return $this->urlGenerator->generate($fieldPath, [$propertyName => $value]);
    }

    /**
     * {@inheritdoc}
     */
    public function transformActionLabel(string $fieldLabel, string $fieldName/**, string $fieldPath **/): string
    {
        return $this->translator->trans($fieldLabel);
    }
}
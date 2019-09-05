<?php

namespace Pizzaminded\Objectable;

use Doctrine\Common\Annotations\AnnotationReader;
use Pizzaminded\Objectable\Annotation\Header;
use Pizzaminded\Objectable\Annotation\Row;
use Pizzaminded\Objectable\Renderer\PhpTemplateRenderer;
use Pizzaminded\Objectable\Transformer\HeaderTransformerInterface;
use Pizzaminded\Objectable\Transformer\ValueTransformerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Objectable
{
    /**
     * @var HeaderTransformerInterface
     */
    protected $headerTransformer;

    /**
     * @var AnnotationReader
     */
    protected $annotationReader;

    /**
     * @var PhpTemplateRenderer
     */
    protected $renderer;

    /**
     * @var ValueTransformerInterface[]
     */
    protected $valueTransformers = [];

    /**
     * Objectable constructor.
     * @param AnnotationReader|null $annotationReader
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function __construct(
        ?AnnotationReader $annotationReader = null
    )
    {
        $this->renderer = new PhpTemplateRenderer();

        if ($annotationReader === null) {
            $this->annotationReader = new AnnotationReader();
        }

    }

    /**
     * @param array|\Countable $data
     * @return string
     * @throws ObjectableException
     * @throws \ReflectionException
     */
    public function renderTable($data): string
    {
        if (!is_iterable($data)) {
            throw new ObjectableException('Passed $data is not iterable');
        }

        if (\count($data) === 0) {
            return $this->renderer->renderNoResultsTemplate();
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $firstElementFetched = false;
        $class = null;
        $index = 0;
        $rows = [];
        $headers = [];

        foreach ($data as $element) {
            $row = [];

            if (!$firstElementFetched) {
                $firstElementFetched = true;
                $class = \get_class($element);
                $reflectionClass = new \ReflectionClass($class);

                $rowAnnotation = $this
                    ->annotationReader
                    ->getClassAnnotation(
                        $reflectionClass,
                        Row::class
                    );

                if ($rowAnnotation === null) {
                    throw new ObjectableException('Class ' . $class . ' has no ' . Row::class . ' annotation defined.');
                }

                $headers = $this->fetchHeadersFromObjectReflection($reflectionClass);
            }

            $propertiesToExtract = \array_keys($headers);

            //extract all things in object
            foreach ($propertiesToExtract as $property) {
                /**
                 * TODO:
                 * - if there is "getter" property in header, use them
                 */
                $value = $propertyAccessor->getValue($element, $property);
                //transform value
                $row[$property] = $this->transformValue($value, $class, $property);
                unset($value);
            }

            //create action fields for each row @TODO
            $rows[$index] = $row;
            $index++;
        }

        $headerTitles = [];

        foreach ($headers as $propertyName => $headerAnnotation) {
            $headerTitles[$propertyName] = $headerAnnotation->getTitle();
        }
        //transform headers @TODO

        //render $row table
        return $this->renderer->renderTable($rows, $headerTitles);

    }

    /**
     * @return HeaderTransformerInterface
     */
    public function getHeaderTransformer(): HeaderTransformerInterface
    {
        return $this->headerTransformer;
    }

    /**
     * @param HeaderTransformerInterface $headerTransformer
     * @return Objectable
     */
    public function setHeaderTransformer(HeaderTransformerInterface $headerTransformer): Objectable
    {
        $this->headerTransformer = $headerTransformer;
        return $this;
    }

    /**
     * @param \ReflectionClass $reflection
     * @return Header[]
     */
    protected function fetchHeadersFromObjectReflection(\ReflectionClass $reflection): array
    {
        $output = [];
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            /** @var Header $annotation */
            $annotation = $this->annotationReader->getPropertyAnnotation($property, Header::class);

            if ($annotation !== null) {
                $output[$property->name] = $annotation;
            }
        }

        return $output;
    }

    /**
     * @param mixed $value
     * @param string $className
     * @param string $propertyName
     * @return string
     * @throws ObjectableException
     */
    protected function transformValue($value, string $className, string $propertyName): ?string
    {
        if (\count($this->valueTransformers) === 0 && \is_array($value)) {
            throw new ObjectableException('Could not transform array value as there are no transformers defined.');
        }

        if (\count($this->valueTransformers) === 0 && $value === null) {
            return '(null)';
        }

        //if there is no value transformers, just return the value
        if (\count($this->valueTransformers) === 0) {
            return $value;
        }

        foreach ($this->valueTransformers as $transformer) {
            $stopPropagation = false;
            $value = $transformer->transform($value, $className, $propertyName, $stopPropagation);

            if ($stopPropagation) {
                return $value;
            }
        }

        return $value;
    }
}
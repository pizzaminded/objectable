<?php

namespace Pizzaminded\Objectable;

use Doctrine\Common\Annotations\AnnotationReader;
use Pizzaminded\Objectable\Annotation\Header;
use Pizzaminded\Objectable\Annotation\Row;
use Pizzaminded\Objectable\Renderer\PhpTemplateRenderer;
use Pizzaminded\Objectable\Transformer\HeaderTransformerInterface;

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
     * Objectable constructor.
     * @param AnnotationReader|null $annotationReader
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function __construct(?AnnotationReader $annotationReader = null)
    {
        $this->renderer = new PhpTemplateRenderer();

        if ($annotationReader === null) {
            $this->annotationReader = new AnnotationReader();
        }

    }

    public function renderTable($data): string
    {
        if (!is_iterable($data)) {
            throw new ObjectableException('Passed $data is not iterable');
        }

        if (\count($data) === 0) {
            return $this->renderer->renderNoResultsTemplate();
        }

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

            //extract values & transform them

            //create action fields for each row

            $rows[$index] = $row;
            $index++;

        }

        //render $row table

        return var_export($data, true);

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


    protected function fetchHeadersFromObjectReflection(\ReflectionClass $reflection): array
    {
        $output = [];
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $annotation = $this->annotationReader->getPropertyAnnotation($property, Header::class);
            $output[$property->name] = $annotation;
        }

        return $output;
    }
}
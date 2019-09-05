<?php

namespace Pizzaminded\Objectable;

use Pizzaminded\Objectable\Transformer\HeaderTransformerInterface;

class Objectable
{
    /**
     * @var HeaderTransformerInterface
     */
    protected $headerTransformer;


    public function renderTable($data)
    {

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

}
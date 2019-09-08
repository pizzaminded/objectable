<?php

namespace Pizzaminded\Objectable;

use Pizzaminded\Objectable\Annotation\ActionField;
use Pizzaminded\Objectable\Annotation\Header;

class RowMetadata
{

    /**
     * @var Header[]
     */
    protected $headers = [];

    protected $propertiesToExtract = [];

    /**
     * @var ActionField[]
     */
    protected $actionFields = [];

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return RowMetadata
     */
    public function setHeaders(array $headers): RowMetadata
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return array
     */
    public function getPropertiesToExtract(): array
    {
        return $this->propertiesToExtract;
    }

    /**
     * @param array $propertiesToExtract
     * @return RowMetadata
     */
    public function setPropertiesToExtract(array $propertiesToExtract): RowMetadata
    {
        $this->propertiesToExtract = $propertiesToExtract;
        return $this;
    }

    /**
     * @return array
     */
    public function getActionFields(): array
    {
        return $this->actionFields;
    }

    /**
     * @param array $actionFields
     * @return RowMetadata
     */
    public function setActionFields(array $actionFields): RowMetadata
    {
        $this->actionFields = $actionFields;
        return $this;
    }


}
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

    /**
     * @var ActionField[]
     */
    protected $actionFields = [];

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        $output = $this->headers;

        if (count($this->actionFields) > 0) {
            $actionFieldHeader = new Header();
            $actionFieldHeader->order = 100000;
            $actionFieldHeader->title = 'objectable.headers';

            $output[] = $actionFieldHeader;
        }

        return $output;
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
        return array_keys($this->headers);
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
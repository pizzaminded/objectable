<?php

namespace Pizzaminded\Objectable\Annotation;

/**
 * @Annotation
 * @Target({"CLASS"})
 *
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ActionField
{

    /**
     * Allows to define action name (e.g. edit, delete etc.)
     * This one will be also rendered as a class (prefixed with "objectable-action-" and passed in action button in "data-objectable-action" attribute
     * @var string
     * @Required
     */
    public $name;

    /**
     * URL (or some route name) where user will be redirected on action field click
     * @Required
     * @var string
     */
    public $path;

    /**
     * @Required
     * @var string
     */
    public $label;

    /**
     * Which value should be passed an value to ActionFieldTransformer?
     * If empty, whole object would be passed
     */
    public $property;

}
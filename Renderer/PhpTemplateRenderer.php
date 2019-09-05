<?php

namespace Pizzaminded\Objectable\Renderer;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class PhpTemplateRenderer
{
    public function renderNoResultsTemplate(): string
    {
        return file_get_contents(__DIR__ . '/../resources/templates/php_default/no_results_found.php');
    }


    public function renderTable(array $rows, array $headers): string
    {
        ob_start();
        include __DIR__ . '/../resources/templates/php_default/table.php';
        return ob_get_clean();
    }
}
<?php

namespace App\Models;

trait HasHtmlDescription
{
    public function descriptionHtml(): string
    {
        $html = $this->description_html ?: '<p>' . nl2br(e($this->description)) . '</p>';
        return HtmlContentFilter::removeScriptsFromHtmlString($html);
    }
}

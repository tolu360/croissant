<?php

use dflydev\markdown\MarkdownExtraParser;

if (!function_exists('md'))
{
    function md($str)
    {
        $markdownParser = new MarkdownExtraParser();

        return $markdownParser->transformMarkdown($str);
    }
}
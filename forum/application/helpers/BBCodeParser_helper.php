<?php

function BBCodeParser($text = null)
{
    $parser = new \SBBCodeParser\Node_Container_Document();

    if ($text == null)
        return $parser;

    return $parser->parse($text)
        ->detect_links()
        ->detect_emails()
        ->detect_emoticons()
        ->get_html();
}
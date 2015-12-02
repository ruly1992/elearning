<?php

if (!function_exists('getModArticle')) {
    function getModArticle() {
        return new Model\Article;
    }
}

if (!function_exists('getArticleByCategory')) {
    function getArticleByCategory($category_id, $limit = 6) {
        return getModArticle()->byCategory($category_id, $limit)->get();
    }
}

if (!function_exists('getContentArticle')) {
    function getContentArticle($article, $wordwrap = 0) {
        if ($wordwrap > 0) {
            $content = strip_tags($article->content);

            return truncate($content, $wordwrap, '...');
        } else {
            return $article->content;
        }
    }
}

if (!function_exists('getLinkArticle')) {
    function getLinkArticle($article) {
        return home_url('/article/' . $article->slug);
    }
}

if (!function_exists('truncate')) {
    function truncate($str, $maxLength = 10, $trailing = '...') {
        $startPos = 0;

        if (strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= $trailing;
        } else {
            $excerpt = $str;
        }
        
        return $excerpt;
    }
}

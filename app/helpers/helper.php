<?php


if (!function_exists('asset')) {

    /**
     * @param string $filePath
     * @return string
     */
    function asset(string $filePath): string
    {
        $host = $_SERVER['HTTP_HOST'];

        return $host . "/" . trim($filePath, '/');
    }
}

if (!function_exists('url')) {

    /**
     * @param string $uri
     * @return string
     */
    function url(string $uri): string
    {
        $host = $_SERVER['HTTP_HOST'];

        return $host . "/" . trim($uri);
    }
}
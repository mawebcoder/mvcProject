<?php


if (!function_exists('asset')) {

    /**
     *
     * get asset files from public directory
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
     * get full url of the uri
     *
     * @param string $uri
     * @return string
     */
    function url(string $uri): string
    {
        $host = $_SERVER['HTTP_HOST'];

        return $host . "/" . trim($uri);
    }
}

if (!function_exists('include')) {

    function includeView(string $path, array $data = [])
    {

        if (sizeof($data)) {
            extract($data);
        }

        return require_once $_SERVER['DOCUMENT_ROOT'] . '/../views/' . trim($path, '/');
    }
}
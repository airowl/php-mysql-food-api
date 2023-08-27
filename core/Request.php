<?php

namespace Core;

class Request
{
    /**
     * Fetch the request URI.
     *
     * @return string
     */
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    /**
     * Fetch the request method.
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getParam()
    {
        return end(explode('/', self::uri()));
    }

    public static function clearUri($uri)
    {
        $string = $uri;
        $start = '{';
        $end = '}';
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return $uri;
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return str_replace('{'.substr($string, $ini, $len).'}', end(explode('/', self::uri())), $uri);
    }
}
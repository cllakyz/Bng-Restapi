<?php


namespace App\Core;

/**
 * Class Request
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Request
{
    /**
     * Request get path
     *
     * @return false|mixed|string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * Request method
     *
     * @return string
     */
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * isGet method
     *
     * @return bool
     */
    public function isGet()
    {
        return $this->method() === 'get';
    }

    /**
     * isPost method
     *
     * @return bool
     */
    public function isPost()
    {
        return $this->method() === 'post';
    }

    /**
     * Get Request body method
     *
     * @return array
     */
    public function getBody()
    {
        $body = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}
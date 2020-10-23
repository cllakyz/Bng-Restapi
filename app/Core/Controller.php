<?php


namespace App\Core;

/**
 * Class Controller
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Controller
{
    /** Class variables */
    public string $layout = 'main';

    /**
     * Set Layout
     *
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Render view func.
     *
     * @param string $view
     * @param array $params
     * @return string|string[]
     */
    public function render(string $view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}
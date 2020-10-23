<?php


namespace App\Core;
/**
 * Class Router
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Router
{
    /** Class variables */
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Router constructor.
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * GET Method
     *
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * POST Method
     *
     * @param $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * request method callback
     *
     * @return mixed|string|string[]
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }

    /**
     * Render view
     *
     * @param string $view
     * @param array $params
     * @return string|string[]
     */
    public function renderView(string $view, array $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->viewContent($view, $params);
        return str_replace('{{ Content }}', $viewContent, $layoutContent);
    }

    /**
     * Get Layout content
     *
     * @return false|string
     */
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . '/resources/views/layouts/' . $layout . '.php';
        return ob_get_clean();
    }

    /**
     * Get view content
     *
     * @param string $view
     * @param array $params
     * @return false|string
     */
    protected function viewContent(string $view, array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . '/resources/views/' . $view . '.php';
        return ob_get_clean();
    }
}
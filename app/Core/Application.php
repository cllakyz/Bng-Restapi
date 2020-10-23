<?php


namespace App\Core;
/**
 * Class Application
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Application
{
    /** Class Static Variables */
    public static string $ROOT_DIR;
    public static Application $app;

    /** Class Variables */
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Controller $controller;

    /**
     * Application constructor.
     *
     * @param $rootPath
     * @param array $config
     */
    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = str_replace('\\', '/', $rootPath);
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
    }

    /**
     * App run method
     */
    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * Get Controller
     *
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * Set Controller
     *
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}
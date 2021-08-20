<?php

namespace app\http;

use app\manager\Application;
use app\manager\Controller;
use Exception;
use ReflectionFunction;
use ReflectionMethod;
use Throwable;

class Router
{
    /**
     * @var string
     */
    private $url = '';

    /**
     * @var string
     */
    private $prefix = '';

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var Request
     */
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        // $this->url = $url;
    }

    /**
     * Add routes
     * 
     * example:
     * ```php
     * [
     *   SiteController::class => [
     *     'GET' => [
     *        'index',
     *        'contact'
     *      ]
     *   ]
     * ]
     * ```
     *
     * @param array $routes
     * @return void
     */
    protected function setRoute(string $method, string $route, string $controller, array $vars)
    {
        $pattern = "/{(.+?)}/";

        if (preg_match_all($pattern, $route, $matches)) {
            $route = preg_replace($pattern, '(.*?)', $route);
            $route_params = $matches[1];
        } else {
            $route_params = [];
        }

        $rules = (array)($vars['rules'] ?? ['@', '?']);
        unset($vars['rules']);

        $this->routes[$method][$route] = [
            'target' => $controller,
            'route-params' => $route_params,
            'query-params' => $vars,
            'rules' => $rules
        ];
    }

    /**
     * Get Controller from route and run action
     *
     * @return void
     */
    public function getRoute()
    {
        $uri = $this->request->getUri();
        $method = $this->request->getMethod();
        $queryParams = $this->request->getQueryParams();

        if (isset($this->routes[$method])) {

            $actions = $this->routes[$method];

            foreach ($actions as $name => $value) {

                $rule = Application::getUser() ? '@' : '?';


                if (!in_array($rule, $value['rules'])) {
                    continue;
                }

                $pattern = "/^" . str_replace('/', '\\/', $name) . "$/";

                if (preg_match($pattern, $uri, $matches)) {
                    unset($matches[0]);
                    $value['route-params'] = array_combine($value['route-params'], $matches);

                    [$controller, $action] = explode('/', $value['target']);

                    $controller = ucwords($controller);
                    $controller = str_replace('-', '', $controller);
                    $controller = "app\\controllers\\{$controller}Controller";

                    $action = ucwords($action);
                    $action = str_replace('-', '', $action);

                    $args = [];
                    $variables = array_merge($value['query-params'], $value['route-params'], $queryParams);

                    $method = "$controller::action{$action}";

                    $reflection = new ReflectionMethod($method);
                    foreach ($reflection->getParameters() as $parameter) {
                        $name = $parameter->getName();

                        if (!array_key_exists($name, $variables)) {
                            throw new Exception("Informe o parâmetro \"$name\"", 500);
                        }

                        $args[] = $variables[$name];
                    }

                    return call_user_func($method, ...$args);
                }
            }

            throw new Exception('Rota não encontrada', 404);
        }
    }


    /**
     * define a route as GET method
     *
     * @param string $route
     * @param array $params
     * @return void
     */
    public function get(string $route, string $controller, array $params = [])
    {
        $this->setRoute('GET', $route, $controller, $params);
    }


    /**
     * define a route as POST method
     *
     * @param string $route
     * @param array $params
     * @return void
     */
    public function post(string $route, string $controller, array $params = [])
    {
        $this->setRoute('POST', $route, $controller, $params);
    }


    /**
     * define a route as PUT method
     *
     * @param string $route
     * @param array $params
     * @return void
     */
    public function put(string $route, string $controller, array $params = [])
    {
        $this->setRoute('PUT', $route, $controller, $params);
    }


    /**
     * define a route as DELETE method
     *
     * @param string $route
     * @param array $params
     * @return void
     */
    public function delete(string $route, string $controller, array $params = [])
    {
        $this->setRoute('DELETE', $route, $controller, $params);
    }

    public function run()
    {
        try {
            $result = $this->getRoute();

            $response = new Response(200, $result);
            $response->send();
        } catch (Throwable $e) {
            $response = new Response($e->getCode(), $e->getMessage());
            $response->send();
        }
    }
}

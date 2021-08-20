<?php

namespace app\manager;

use app\http\Request;
use app\models\User;

abstract class Controller
{

    public const LAYOUT = 'main';

    /**
     * Converts className to lowercase separated by dash
     *
     * @return string
     */
    protected static function getId(): string
    {
        $namespace = explode('\\', static::class);

        $className = str_replace('Controller', '', end($namespace));
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
    }

    /**
     * Returns view's content
     *
     * @param string $view
     * @return string
     */
    public static function render($view, $vars = []): string
    {
        $_vars = [
            'user' => Application::getUser()
        ];

        $vars = array_merge($_vars, $vars);

        $content = View::render('layout', static::LAYOUT, array_merge($vars, [
            'content' => View::render(self::getId(), $view, $vars)
        ]));

        unset($_SESSION['flash']);

        return $content;
    }

    /**
     * Get Request instance
     *
     * @return Request
     */
    public static function getRequest(): Request
    {
        return new Request();
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
        die;
    }

    /**
     * Adds a message to be displayed on an Alert
     *
     * @param string $key
     * @param array|string $value
     * @return void
     */
    public static function setFlash(string $key, $value)
    {
        $_SESSION['flash'][$key] = (array)$value;
    }
}

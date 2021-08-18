<?php 

namespace app\manager;

use app\http\Request;

abstract class Controller {

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
    public static function render($view, $vars = []): string {
        $content = View::render('layout', 'main', [
            'content' => View::render(self::getId(), $view, $vars)
        ]);

        unset($_SESSION['flash']);


        return $content;
    }

    /**
     * Get Request instance
     *
     * @return Request
     */
    public static function getRequest(): Request {
        return new Request();
    }   

    public static function redirect($url) {
        header('Location: ' . $url);
        die;
    }

    public static function setFlash(string $key, string $value) {
        $_SESSION['flash'][$key] = $value;
    }
}

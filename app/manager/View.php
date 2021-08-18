<?php

namespace app\manager;

use app\http\Response;

class View
{
    /**
     * Returns view's rendered content
     *
     * @param string $controller
     * @param string $view
     * @return string
     */
    public static function render($view)
    {

        $contentView = self::getContentView($view);

        return $contentView;
    }

    /**
     * Returns view's content
     *
     * @param string $controller
     * @param string $view
     * @return string
     */
    protected static function getContentView($view)
    {
        $path = Application::getAlias('@src');
        $file = $path . '/views/' . "$view.php";

        return file_exists($file) ? require $file : null;
    }
}

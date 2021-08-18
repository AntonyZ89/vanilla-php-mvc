<?php

namespace app\manager;

class View
{
    /**
     * Returns view's content
     *
     * @param string $folder
     * @param string $view
     * @return string
     */
    public static function render($folder, $view, $vars = [])
    {
        $file = Application::getAlias('@src') . "/views/$folder/$view.php";

        return file_exists($file) ? self::renderFile($file, $vars) : null;
    }

    protected static function renderFile($path, $vars = [])
    {
        ob_start();
        extract($vars);
        include $path;
        return ob_get_clean();
    }
}

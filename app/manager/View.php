<?php

namespace app\manager;

use Exception;

class View
{
    /**
     * Returns view's content
     *
     * @param string $folder
     * @param string $view
     * @return string
     * @throws Exception
     */
    public static function render($folder, $view, $vars = [])
    {
        $file = Application::getAlias('@src') . "/views/$folder/$view.php";

        if(file_exists($file)) {
            return self::renderFile($file, $vars);
        } else {
            throw new Exception("'$file' not found.");
        }
    }

    protected static function renderFile($path, $vars = [])
    {
        ob_start();
        extract($vars);
        include $path;
        return ob_get_clean();
    }
}

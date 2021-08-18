<?php

namespace app\manager;

use Exception;

class Application
{
    /**
     *
     * Folder alias
     *
     * @var string $alias
     * @var string $path
     */
    protected static $alias = [];

    public static function setAlias(string $alias, string $path)
    {
        self::$alias[$alias] = $path;
    }

    /**
     * Returns path
     *
     * @param string $alias
     * @return string
     * @throws Exception
     */
    public static function getAlias(string $alias)
    {
        if (!isset(self::$alias[$alias])) {
            throw new Exception("Path to \"$alias\" not found.", 500);
        }

        return self::$alias[$alias];
    }
}

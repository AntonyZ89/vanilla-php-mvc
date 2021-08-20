<?php

namespace app\manager;

use app\models\User;
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

    /**
     * @var User|null
     */
    protected static $user;


    /**
     * @var array|null
     */
    protected static $config;

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

    /**
     * Returns logged user
     *
     * @return User|null
     */
    public static function getUser()
    {
        if (isset($_SESSION['user']) && self::$user === null) {
            self::$user = User::get(['id' => $_SESSION['user']['id']]);

            if (!self::$user) {
                unset($_SESSION['user']);
            }
        }

        return self::$user;
    }


    /**
     * Returns system config
     *
     * @return array
     */
    public static function getConfig(): array {
        if (self::$config === null) {
            self::$config = require self::getAlias('@config') . '/main.php';
        }

        return self::$config;
    }
}

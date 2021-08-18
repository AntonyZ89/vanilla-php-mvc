<?php

namespace app\controllers;

use app\manager\View;

class SiteController
{
    /**
     * Returns home view
     *
     * @return string
     */
    public static function actionIndex()
    {
        return View::render('site/index');
    }
}

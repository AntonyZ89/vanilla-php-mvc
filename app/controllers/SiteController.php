<?php

namespace app\controllers;

use app\manager\Controller;

class SiteController extends Controller
{
    /**
     * Returns home view
     *
     * @return string
     */
    public static function actionIndex()
    {

        return self::render('index');
    }

    /**
     * Render about view
     *
     * @return string
     */
    public static function actionAbout()
    {
        return self::render('about');
    }
}

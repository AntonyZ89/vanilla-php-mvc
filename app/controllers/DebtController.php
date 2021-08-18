<?php

namespace app\controllers;

use app\manager\Controller;

class DebtController extends Controller
{
    public static function actionIndex()
    {
        return self::render('index');
    }
}

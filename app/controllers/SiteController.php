<?php

namespace app\controllers;

use app\manager\Application;
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
     * User profile
     *
     * @return string
     */
    public static function actionProfile()
    {
        $user = Application::getUser();
        $request = self::getRequest();

        if ($request->isPost()) {
            $user->load($request->getPost());
            $password = $request->getPost('password');

            $confirmPassword = $request->getPost('confirm-password');

            $user->setPassword($password, $confirmPassword);
            if ($user->save()) {
                self::setFlash('success', 'Perfil atualizado com sucesso');
            }
        }

        return self::render('profile', ['user' => $user]);
    }
}

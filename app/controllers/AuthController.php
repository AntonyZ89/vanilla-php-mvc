<?php

namespace app\controllers;

use app\manager\Controller;
use app\models\User;

class AuthController extends Controller
{

    public const LAYOUT = 'login';

    /**
     * Render login view
     *
     * @return string
     */
    public static function actionLogin()
    {
        $request = self::getRequest();
        if ($request->isPost()) {
            $document = $request->getPost('document');
            $password = $request->getPost('password');

            if (!$document || !$password) {
                self::setFlash('danger', 'CPF/CNPJ ou senha incorretos');
                self::redirect('/login');
            }

            $model = User::get(['document' => $document]);
            
            if ($model && $model->validatePassword($password)) {
                self::handleLogin($model);
                self::redirect('/');
            }

            self::setFlash('danger', 'CPF/CNPJ ou senha incorretos');
        }

        return self::render('login');
    }

    public static function actionSignup()
    {
        $request = self::getRequest();
        $model = new User();

        if ($request->isPost()) {
            $model->load($request->getPost());

            $password =  $request->getPost('password');
            $confirm_password =  $request->getPost('confirm-password');

            $model->setPassword($password, $confirm_password);

            if ($model->save()) {
                self::handleLogin($model);
                self::redirect('/');
            }
        }

        return self::render('signup', [
            'model' => $model
        ]);
    }


    /**
     * Logout and back to site/index
     *
     * @return string
     */
    public static function actionLogout()
    {
        unset($_SESSION['user']);

        self::redirect('/');
    }

    public static function handleLogin(User $model)
    {
        $_SESSION['user'] = [
            'id' => $model->getId()
        ];
    }
}

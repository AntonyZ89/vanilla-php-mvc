<?php

namespace app\controllers;

use app\manager\Controller;
use app\models\Debt;

class DebtController extends Controller
{
    public static function actionIndex()
    {
        $models = Debt::listByUser(self::getUser()->getId());

        return self::render('index', [
            'debts' => $models
        ]);
    }

    public static function actionSave()
    {
        $request = self::getRequest();
        $post = $request->getPost();

        $model = new Debt();
        $model->setUserId(self::getUser()->getId());
        $model->load($post);

        $new = $model->isNewRecord();

        $model->save();

        if ($new) {
            self::setFlash('success', 'Dívida cadastrada com sucesso!');
        } else {
            self::setFlash('success', 'Dívida atualizada com sucesso!');
        }

        self::redirect('/debt');
    }

    public static function actionDelete($id)
    {
        $model = Debt::get(['id' => $id]);
        $model->delete();

        self::redirect('/debt');
    }
}

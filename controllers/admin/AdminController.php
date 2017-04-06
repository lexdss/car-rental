<?php

namespace app\controllers\admin;

use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

class AdminController extends  Controller
{
    public $layout = '@app/views/layouts/admin/main.php';

    /**
     * @return string
     */
    public function getViewPath()
    {
        return '@app/views/admin';
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $acion) {
                            return Yii::$app->user->identity->role == 'admin';
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
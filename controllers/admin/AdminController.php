<?php

namespace app\controllers\admin;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class AdminController extends  Controller
{
    public $layout = '@app/views/layouts/admin/main.php';

    /**
     * @inheritdoc
     */
    public function getViewPath()
    {
        if ($this->id == 'admin/admin')
            return '@app/views/admin';

        return '@app/views/' . $this->id;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role == 'admin';
                        }
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
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
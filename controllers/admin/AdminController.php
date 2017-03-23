<?php

namespace app\controllers\admin;

use yii\web\Controller;

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

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
<?php

namespace app\controllers\admin;

use app\models\admin\search\UserSearch;
use Yii;

class UserController extends AdminController
{
    /**
     * @return string
     */
    public function getViewPath()
    {
        return '@app/views/admin/user';
    }

    /**
     * User list
     *
     * @return string
     */
    public function actionIndex()
    {
        $userSearch = new UserSearch(['scenario' => UserSearch::SCENARIO_SEARCH]);
        $dataProvider = $userSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $userSearch]);
    }
}
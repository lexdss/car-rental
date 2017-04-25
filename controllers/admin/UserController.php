<?php

namespace app\controllers\admin;

use Yii;
use yii\web\NotFoundHttpException;
use app\models\admin\search\UserSearch;
use app\models\User;

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

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * @param $id
     * @return \app\models\User
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
<?php

namespace app\components\behaviors;

use Yii;
use yii\base\Behavior;
use app\models\Order;

class SendEmailBehavior extends Behavior
{
    public function events()
    {
        return [
            Order::EVENT_AFTER_INSERT => 'sendOrderEmail',
        ];
    }

    //Send email after new order
    public function sendOrderEmail()
    {
        Yii::$app->mailer->compose('user-order', ['order' => $this->owner, 'user' => Yii::$app->user->identity])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo(Yii::$app->user->identity->email)
            ->setSubject('Заявка на аренду авто принята')
            ->send();

        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Новая заявка на сайте')
            ->setTextBody('На сайте оставили новую заявку')
            ->send();
    }
}
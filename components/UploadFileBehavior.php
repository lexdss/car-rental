<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use app\models\helpers\FileHelper;

class UploadFileBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_VALIDATE => 'saveFile'
        ];
    }

    public function saveFile($event)
    {
        if ($file = UploadedFile::getInstance($event->sender, 'file')){
            $fileName = FileHelper::getRandomPath($file);

            if ($file->saveAs(Yii::getAlias('@uploadroot') . $fileName)) {
                $event->sender->img = Yii::getAlias('@uploadweb') . $fileName;
            }
        }
    }
}
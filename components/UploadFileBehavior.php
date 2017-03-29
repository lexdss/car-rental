<?php

namespace app\components;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\web\UploadedFile;
use app\models\helpers\FileHelper;

/**
 * Class UploadFileBehavior
 * @package app\components
 */
class UploadFileBehavior extends AttributeBehavior
{
    public function getValue($event)
    {
        if ($file = UploadedFile::getInstance($this->owner, 'file')){
            $fileName = FileHelper::getRandomPath($file);

            if ($file->saveAs(Yii::getAlias('@uploadroot') . $fileName)) {
                return Yii::getAlias('@uploadweb') . $fileName;
            }

            return null;
        }

        return $this->owner->img;
    }
}
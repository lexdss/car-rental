<?php

namespace app\components\behaviors;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\web\UploadedFile;
use app\components\helpers\FileHelper;
use yii\db\ActiveRecord;

/**
 * Class UploadFileBehavior
 * @package app\components
 */
class UploadFileBehavior extends AttributeBehavior
{
    public function getValue($event)
    {
        // Only save|update
        if ($this->owner->scenario != ActiveRecord::SCENARIO_DEFAULT)
            return null;

        if ($file = UploadedFile::getInstance($this->owner, 'file')) {
            $fileName = FileHelper::getRandomPath($file);

            if ($file->saveAs(Yii::getAlias('@uploadroot') . $fileName)) {
                return Yii::getAlias('@uploadweb') . $fileName;
            } else {
                $this->owner->addError('file', 'Не удалось загрузить файл');
            }

        } elseif (isset($this->owner->img)) {
            return $this->owner->img;
        } else {
            $this->owner->addError('file', 'Загрузите файл');
        }

        return null;
    }
}
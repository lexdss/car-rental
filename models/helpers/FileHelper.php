<?php

namespace app\models\helpers;

use yii\web\UploadedFile;
use Yii;

class FileHelper
{
    /**
     * @param $file UploadedFile
     * @return string
     */
    public static function getRandomPath($file)
    {
        return '/' . Yii::$app->security->generateRandomString() . '.' . $file->extension;
    }
}
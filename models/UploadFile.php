<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    public $file;

    public function __construct(UploadedFile $file, $config = [])
    {
        parent::__construct($config);

        $this->file = $file;
    }

    /**
     * @return string|boolean File path or false
     */
    public function save()
    {
        $fileName = FileHelper::getRandomPath($this->file);

        if ($this->file->saveAs(Yii::getAlias('@uploadroot') . $fileName)) {
            return Yii::getAlias('@uploadweb') . $fileName;
        }else{
            return false;
        }
    }
}
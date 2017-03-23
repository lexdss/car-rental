<?php

namespace app\models;

use Codeception\Lib\Interfaces\ActiveRecord;
use Yii;
use yii\web\UploadedFile;
use app\models\UploadFile;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $img
 * @property integer $up_date
 *
 * @property Car[] $cars
 * @property UploadFile $file
 */
class Company extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';

    public $file;

    /**
     * Update up_date column when save and update model
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['up_date'],
                    self::EVENT_BEFORE_UPDATE => ['up_date']
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'name', 'slug', 'file'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['description', 'name', 'slug'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['description'], 'string', 'max' => 2000],
            [['name', 'slug'], 'string', 'max' => 30, 'min' => 2],
            [['file'], 'file', 'extensions' => ['jpg', 'png', 'gif'], 'maxSize' => 1024 * 1024 * 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'slug' => 'Символьный код',
            'description' => 'Описание',
            'file' => 'Логотип',
            'up_date' => 'Изменение'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['company_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($file = UploadedFile::getInstance($this, 'file')) {
            $this->file = new UploadFile($file);

            if (!$this->img = $this->file->save())
                $this->addError('file', 'Изображение не загружено');
        }

        return parent::save($runValidation, $attributeNames);
    }
}

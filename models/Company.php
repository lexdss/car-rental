<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\components\UploadFileBehavior;

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
 */
class Company extends ActiveRecord
{

    public $file;

    /**
     * Update up_date column when save and update model
     */
    public function behaviors()
    {
        return [
            [
                'class' => UploadFileBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_VALIDATE => ['img'],
                ],
            ],
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
            [['description', 'name', 'slug'], 'required'],
            [['description'], 'string', 'max' => 2000],
            [['name', 'slug'], 'string', 'max' => 30, 'min' => 2],
            ['file', 'file', 'extensions' => ['jpg', 'png', 'gif'], 'maxSize' => 1024 * 1024 * 5],
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
}

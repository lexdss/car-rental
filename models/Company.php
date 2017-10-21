<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\components\behaviors\UploadFileBehavior;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property string $img
 * @property integer $upDate
 *
 * @property Car[] $cars
 */
class Company extends ActiveRecord
{

    public $file;

    /**
     * Update up_date column when save and update model
     * @inheritdoc
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
                    self::EVENT_BEFORE_INSERT => ['upDate'],
                    self::EVENT_BEFORE_UPDATE => ['upDate']
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug', 'content'], 'trim'],
            [['content'], 'string', 'max' => 10000],
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
            'content' => 'Описание',
            'file' => 'Логотип',
            'img' => 'Логотип',
            'upDate' => 'Изменение'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['companyId' => 'id']);
    }
}

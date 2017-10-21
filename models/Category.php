<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\components\behaviors\UploadFileBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $previewContent
 * @property string $content
 * @property string $img
 * @property integer $upDate
 *
 * @property Car[] $cars
 */
class Category extends ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{category}}';
    }

    /**
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
                    self::EVENT_BEFORE_UPDATE => ['upDate'],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug', 'content', 'previewContent'], 'trim'],
            ['content', 'string', 'max' => 10000],
            ['previewContent', 'string', 'max' => 500],
            [['name', 'slug'], 'string', 'max' => 30, 'min' => 2],
            [['slug'], 'unique'],
            ['file', 'file', 'extensions' => ['jpg', 'png', 'gif'], 'maxSize' => 1024 * 1024 * 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'slug' => 'Символьный код',
            'previewContent' => 'Анонс',
            'description' => 'Описание',
            'img' => 'Изображение',
            'file' => 'Изображение',
            'upDate' => 'Изменение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['categoryId' => 'id']);
    }
}

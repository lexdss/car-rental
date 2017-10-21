<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $type
 * @property string $content
 * @property string $previewContent
 * @property integer $upDate
 */
class Page extends ActiveRecord
{
    const SCENARIO_PAGE = 'page';
    const SCENARIO_NEWS = 'news';

    const TYPES = [
        self::SCENARIO_PAGE => 'Страница',
        self::SCENARIO_NEWS => 'Новость'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{page}}';
    }

    public function behaviors()
    {
        return [
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
    public function rules()
    {
        return [
            [['slug', 'name', 'content', 'previewContent', 'type'], 'required'],
            [['slug', 'name', 'content', 'previewContent', 'title', 'keywords', 'description'], 'trim'],
            [['slug'], 'string', 'max' => 30],
            [['name', 'title', 'keywords', 'description'], 'string', 'max' => 255],
            ['content', 'string', 'max' => 65000],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Символьный код',
            'name' => 'Название',
            'type' => 'Тип страницы',
            'content' => 'Текст',
            'previewContent' => 'Анонс',
            'upDate' => 'Изменение',
        ];
    }
}

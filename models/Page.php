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
 * @property integer $up_date
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
        return 'page';
    }

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
    public function rules()
    {
        return [
            [['slug', 'name', 'type', 'content'], 'required'],
            [['slug', 'name', 'type', 'content'], 'trim'],
            [['slug'], 'string', 'max' => 25],
            ['name', 'string', 'max' => 255],
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
            'up_date' => 'Изменение',
        ];
    }

    public function getShortDescription()
    {
        return strip_tags(trim(mb_substr($this->content, 0, 400))); // TODO Другой способ вывода анонсов
    }

    public function getUpDate()
    {
        return Yii::$app->formatter->asDate($this->up_date);
    }
}

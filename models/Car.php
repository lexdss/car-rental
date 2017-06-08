<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\components\behaviors\UploadFileBehavior;
use app\components\behaviors\SaveDiscountBehavior;

/**
 * This is the model class for table "car".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $category_id
 * @property string $name
 * @property string $slug // TODO автотранслит
 * @property integer $year
 * @property integer $speed
 * @property string $engine
 * @property string $color
 * @property string $transmission
 * @property string $privod
 * @property string $description
 * @property integer $price
 * @property string $img
 * @property integer $up_date
 *
 * @property Company $company
 * @property Category $category
 * @property Order[] $orders
 */
class Car extends ActiveRecord
{
    public $file;
    public $car_discount;

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
            ],
            [
                'class' => SaveDiscountBehavior::className(),
                'attribute' => 'car_discount'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'company_id',
                    'category_id',
                    'year',
                    'speed',
                    'price',
                ],
                'integer'
            ],
            [
                [
                    'name',
                    'slug',
                    'year',
                    'speed',
                    'engine',
                    'color',
                    'transmission',
                    'privod',
                    'price'
                ],
                'required'
            ],
            [
                [
                    'name',
                    'slug',
                    'year',
                    'speed',
                    'engine',
                    'color',
                    'transmission',
                    'privod',
                    'price',
                    'description',
                ],
                'trim'
            ],
            [['name', 'slug'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 2000],
            [['engine', 'color', 'transmission', 'privod'], 'string', 'max' => 25],
            ['file', 'file', 'extensions' => ['jpg', 'png', 'gif'], 'maxSize' => 1024 * 1024 * 5],
            [['slug'], 'unique'],
            [
                ['company_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Company::className(),
                'targetAttribute' => ['company_id' => 'id']],
            ['discount', 'app\components\validators\DiscountValidator'] // Delegation
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Марка',
            'companyName' => 'Марка',
            'name' => 'Название',
            'fullName' => 'Название',
            'slug' => 'Символьный код',
            'category_id' => 'Категория',
            'categoryName' => 'Категория',
            'year' => 'Год выпуска',
            'speed' => 'Скорость',
            'engine' => 'Двигатель',
            'color' => 'Цвет',
            'transmission' => 'КПП',
            'privod' => 'Привод',
            'description' => 'Описание',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'file' => 'Изображение',
            'img' => 'Изображение',
            'up_date' => 'Изменение'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['car_id' => 'id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getDiscount()
    {
        if (!$this->isNewRecord) {
            return $this->hasMany(Discount::className(), ['car_id' => 'id'])->all();
        }

        return $this->car_discount;
    }

    /**
     * @param array $value
     */
    public function setDiscount($value)
    {
        $this->car_discount = $value;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->company->name . ' ' . $this->name;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->company->name;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category->name;
    }
}

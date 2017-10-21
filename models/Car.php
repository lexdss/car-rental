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
 * @property integer $companyId
 * @property integer $categoryId
 * @property string $name
 * @property string $slug // TODO автотранслит
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property integer $price
 * @property integer $minPrice
 * @property string $doors
 * @property integer $passengers
 * @property integer $conditioner
 * @property string $transmission
 * @property string $transmissionChar
 * @property string $engine
 * @property integer $speed
 * @property integer $fuelConsumption
 * @property string $drive
 * @property integer $trunkVolume
 * @property string $bodyStyle
 * @property string $color
 * @property integer $year
 * @property string $img
 * @property integer $upDate
 * @property string $fullName
 * @property string $categoryName
 * @property string $companyName
 * @property string $shortDescription
 * @property string $conditionerOptions
 * @property string $conditionerString
 * @property string $conditionerChar
 * @property array $options
 * @property string $speedString
 * @property string $fuelConsumptionString
 * @property string $trunkVolumeString
 *
 * @property Company $company
 * @property Category $category
 * @property Order[] $orders
 * @property Discount[] | array $discount
 * @property Discount $maxDiscount
 * @property Company[] | array $companies
 * @property Category[] | array $categories
 */
class Car extends ActiveRecord
{
    const OPTION_CONDITIONER_NO = 0;
    const OPTION_CONDITIONER_YES = 1;

    public $file;

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
                    self::EVENT_BEFORE_UPDATE => ['upDate']
                ]
            ],
            [
                'class' => SaveDiscountBehavior::className(),
                'attribute' => 'discount'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{car}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'speed', 'price', 'doors', 'passengers', 'fuelConsumption', 'trunkVolume'], 'integer'],
            [
                [
                    'name',
                    'slug',
                    'companyId',
                    'categoryId',
                    'price',
                    'doors',
                    'passengers',
                    'conditioner',
                    'transmission',
                    'engine',
                    'speed',
                    'drive',
                    'bodyStyle',
                    'year'
                ],
                'required'
            ],
            [
                [
                    'name',
                    'slug',
                    'price',
                    'doors',
                    'passengers',
                    'conditioner',
                    'transmission',
                    'engine',
                    'speed',
                    'drive',
                    'bodyStyle',
                    'year',
                    'title',
                    'keywords',
                    'description',
                    'fuelConsumption',
                    'trunkVolume',
                    'color'
                ],
                'trim'
            ],
            [['name', 'slug'], 'string', 'max' => 30, 'min' => 2],
            [['content'], 'string', 'max' => 10000],
            [
                [
                    'title',
                    'keywords',
                    'description',
                    'transmission',
                    'engine',
                    'drive',
                    'bodyStyle',
                    'color'
                ],
                'string', 'max' => 255],
            ['file', 'file', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'maxSize' => 1024 * 1024 * 5],
            [['slug'], 'unique'],
            [
                ['companyId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Company::className(),
                'targetAttribute' => ['companyId' => 'id']],
            ['discount', 'app\components\validators\DiscountValidator'], // Delegation
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'fullName' => 'Название',
            'slug' => 'Символьный код',
            'categoryId' => 'Категория',
            'categoryName' => 'Категория',
            'companyId' => 'Марка',
            'companyName' => 'Марка',
            'content' => 'Контент',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'file' => 'Изображение',
            'img' => 'Изображение',
            'upDate' => 'Изменение',
            'year' => 'Год выпуска',
            'speed' => 'Скорость',
            'engine' => 'Двигатель',
            'color' => 'Цвет',
            'transmission' => 'КПП',
            'drive' => 'Привод',
            'fuelConsumption' => 'Расход топлива',
            'trunkVolume' => 'Объем багажника',
            'bodyStyle' => 'Тип кузова',
            'conditioner' => 'Кондиционер',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'companyId']);
    }

    /**
     * @return array|Company[]
     */
    public function getCompanies()
    {
        return Company::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    /**
     * @return array|Category[]
     */
    public function getCategories()
    {
        return Category::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['carId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasMany(Discount::className(), ['carId' => 'id'])->orderBy(['discount' => SORT_ASC]);
    }

    /**
     * @param array $value
     */
    public function setDiscount($value)
    {
        $this->discount = $value;
    }

    /**
     * @return Discount
     */
    public function getMaxDiscount()
    {

        return (is_array($this->discount)) ? $this->discount[count($this->discount) - 1] : new Discount(['discount' => 0]);
    }

    /**
     * @return integer
     */
    public function getMinPrice()
    {
        return intval($this->price - $this->price / 100 * $this->maxDiscount->discount);
    }

    /**
     * @return string
     */
    public function getConditionerChar()
    {
        switch ($this->conditioner) {
            case self::OPTION_CONDITIONER_YES:
                return '+';
            case self::OPTION_CONDITIONER_NO:
                return '—';
            default:
                return '—';
        }
    }

    /**
     * @return string
     */
    public function getTransmissionChar()
    {
        return strtoupper(mb_substr($this->transmission, 0, 1));
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
    public function getCategoryName()
    {
        return $this->category->name;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->company->name;
    }

    /**
     * @return array
     */
    public static function getConditionerOptions()
    {
        return [
            self::OPTION_CONDITIONER_NO => 'Нет',
            self::OPTION_CONDITIONER_YES => 'Есть',
        ];
    }

    /**
     * @return string
     */
    public function getConditionerString()
    {
        return $this->conditionerOptions[$this->conditioner];
    }

    /**
     * @return string
     */
    public function getSpeedString()
    {
        return (isset($this->speed)) ? $this->speed . ' км/ч' : null;
    }

    /**
     * @return string
     */
    public function getTrunkVolumeString()
    {
        return (isset($this->trunkVolume)) ? $this->trunkVolume . ' л' : null;
    }

    /**
     * @return string
     */
    public function getFuelConsumptionString()
    {
        return (isset($this->fuelConsumption)) ? $this->fuelConsumption . ' л/100 км' : null;
    }

    /**
     * @param integer $chars
     * @return string
     */
    public function getShortDescription($chars = 300)
    {
        return strip_tags(trim(mb_substr($this->content, 0, $chars)));
    }

    public function getOptions()
    {
        return [
            $this->getAttributeLabel('year') => $this->year,
            $this->getAttributeLabel('speed') => $this->speedString,
            $this->getAttributeLabel('engine') => $this->engine,
            $this->getAttributeLabel('color') => $this->color,
            $this->getAttributeLabel('transmission') => $this->transmission,
            $this->getAttributeLabel('drive') => $this->drive,
            $this->getAttributeLabel('fuelConsumption') => $this->fuelConsumptionString,
            $this->getAttributeLabel('trunkVolume') => $this->trunkVolumeString,
            $this->getAttributeLabel('bodyStyle') => $this->bodyStyle,
            $this->getAttributeLabel('conditioner') => $this->conditionerString,
        ];
    }
}

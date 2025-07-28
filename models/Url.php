<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
* URL
*/
class Url extends ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public function behaviors()
    {
        return [TimestampBehavior::class,];
    }

    /**
    * {@inheritdoc}
    */
    public static function tableName(): string
    {
        return '{{%url}}';
    }

    /**
    * {@inheritdoc}
    */
    public function rules(): array
    {
        return [
            [['href'], 'required',]
            , [['href'], 'url',]
            , [['href'], 'checkAvailable',]
            , [['alias',], 'required',]
            ,
        ];
    }

    /**
    * {@inheritdoc}
    */
    protected function generateAlias()
    {
        $this->alias = Yii::$app->security->generateRandomString();
    }

    /**
    * {@inheritdoc}
    */
    public function init()
    {
        parent::init();

        $this->on(self::EVENT_BEFORE_VALIDATE, [$this, 'generateAlias',]);
    }

    /**
    * {@inheritdoc}
    */
    public function checkAvailable(string $attribute, ?array $params)
    {
        try {
            $headers = get_headers($this->$attribute);

            if (preg_match('{\b[1-3]\d\d\b}uis', $headers[0]))
                return;
        } catch (\Throwable $exception) {
            error_log($exception->getMessage());
        }

        $this->addError($attribute, 'Ссылка недоступна или неверна');
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID'
            , 'href' => 'Адрес ссылки'
            ,
        ];
    }
}

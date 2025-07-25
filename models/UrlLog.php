<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
* Журнал запросов alias
*/
class UrlLog extends ActiveRecord
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
        return '{{%url_log}}';
    }

    /**
    * {@inheritdoc}
    */
    public function rules(): array
    {
        return [
            [['url_id',], 'required',]
            , [['url_id',], 'integer',]
            , [['ip',], 'ip',]
            ,
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID'
            , 'ip' => 'IP'
            , 'url_id' => 'ID URL'
            ,
        ];
    }
}

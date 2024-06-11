<?php

namespace app\models;

use yii\db\ActiveRecord;

class Slider extends ActiveRecord
{
    public static function getSlides()
    {
        return self::find()->orderBy('id')->all();
    }
}
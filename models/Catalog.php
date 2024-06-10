<?php

namespace app\models;

use yii\db\ActiveRecord;

class Catalog extends ActiveRecord
{
    public static function getRatingCatalog() : array
    {
        return self::findBySql("SELECT * FROM ".static::tableName()." WHERE voices >= 10 ORDER BY rating DESC LIMIT 6")->all();
    }
    public static function getCompilateCatalog() : array
    {
        return self::findBySql("SELECT * FROM ".static::tableName()." ORDER BY rand() LIMIT 9")->all();
    }
}
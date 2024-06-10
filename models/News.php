<?php

namespace app\models;

use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public static function getLastNews() : array
    {
        return self::findBySql(sql: 'SELECT * FROM '.static::tableName().' ORDER BY date DESC LIMIT 3')->all();
    }
    public static function getNews(int $count) : array
    {
        return  self::findBySql(
            sql: 'SELECT * FROM ' .static::tableName().' ORDER BY date DESC LIMIT :limit',
            params: [':limit'=>$count]
        )->all();
    }
}
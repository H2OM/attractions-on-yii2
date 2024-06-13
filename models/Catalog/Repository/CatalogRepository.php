<?php
namespace app\models\Catalog\Repository;
use app\models\Catalog\Catalog;

class CatalogRepository
{

    public static function finByPk($id)
    {
        return Catalog::findBySql("SELECT * FROM Catalog WHERE id = :id", [':id'=> $id])->one();
    }

    /**
     * Получение каталога отсортированного по рейтингу
     *
     * @return array
     */
    public static function getRatingCatalog() : array
    {
        return Catalog::findBySql("SELECT * FROM ".Catalog::tableName()." WHERE voices >= 10 ORDER BY rating DESC LIMIT 6")->all();
    }

    /**
     * Получение каталога со случайной подборкой
     *
     * @return array
     */
    public static function getCompilateCatalog() : array
    {
        return Catalog::findBySql("SELECT * FROM ".Catalog::tableName()." ORDER BY rand() LIMIT 9")->all();
    }

    /**
     * Получение всего каталога
     *
     * @param string $count
     * @return array
     */
    public static function getCatalog(string $count) : array
    {
        return Catalog::findBySql("SELECT * FROM " . Catalog::tableName() . " ORDER BY title ASC LIMIT :limit, 9",
            params: [':limit'=>$count])->all();
    }
    public static function getAllCatalog() : array
    {
        return Catalog::findBySql("SELECT * FROM " . Catalog::tableName() . " ORDER BY title ASC")->all();
    }
}
<?php

namespace app\services;

use yii\web\BadRequestHttpException;

class FormValidator
{

    /**
     * Все существующие методы для каждого поля
     *
     * @var string[]
     */
    private static $properties = ['name', 'number', 'agreement', 'text', 'mail'];


    /**
     * Проверка каждого значения переданного массива на существование такого метода
     * И
     * Корректную валидацию
     * Если нет то выброс Bad Request 400
     *
     * @param array $values
     * @throws bool
     */
    public static function validate(array $values): bool
    {
        foreach ($values as $key => $value) {
            if (!in_array($key, static::$properties) || !self::$key($value)) {
                    return false;
            }
        }
        return true;
    }

    /**
     * Проверка поля имени
     * Поле должно содержать только цифры и пробелы
     * Не должно быть больше 1 пробела подряд
     *
     * @param string $value
     * @return bool
     */
    private static function name(string $value): bool
    {
        $isNameContainsTwoOrMoreSpaces = (preg_match("/[ ]{2,}/", $value) !== 0);

        $isNameOnlyWordsAndSpaces = preg_match("/^[А-я ]+$/u", $value);

        return ($isNameOnlyWordsAndSpaces && !$isNameContainsTwoOrMoreSpaces && strlen($value) > 2);
    }

    /**
     * Проверка поля номера телефона
     * Должно быть 10 цифр или пусто
     *
     * @param string $value
     * @return bool
     */
    private static function number(string $value): bool
    {
        if ($value == '') {
            return true;
        }

        return (preg_match("/^\d+$/", $value) && strlen($value) == 10);
    }

    /**
     * Проверка поля соглашения
     * Должно равняться единице
     *
     * @param string $value
     * @return bool
     */
    private static function agreement(string $value): bool
    {
        return $value == 'on';
    }

    /**
     * Проверка поля textarea
     * Должно быть больше 10 и не больше 1200 символов
     *
     * @param string $value
     * @return bool
     */
    private static function text(string $value): bool
    {
        return (strlen($value) <= 1200 && strlen($value) >= 10);
    }

    /**
     * Проверка поля электронной почты
     * Валидация php валидатором почты
     *
     * @param string $value
     * @return bool
     */
    private static function mail(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
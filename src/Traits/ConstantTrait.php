<?php


namespace App\Traits;

use \ReflectionClass;

trait ConstantTrait
{
    /**
     * Возвращает список всех констант набора
     *
     * @return array
     */
    public static function getAll() : array
    {
        $reflection = new ReflectionClass(static::class);

        return $reflection->getConstants();
    }

    /**
     * Возвращает список значений всех констант набора
     *
     * @return array
     */
    public static function getAllValues() : array
    {
        return array_values(static::getAll());
    }

    /**
     * Возвращает список имен всех констант набора
     *
     * @return array
     */
    public static function getAllNames() : array
    {
        return array_keys(static::getAll());
    }

    public static function getInfoArray() : array
    {
        $result = [];
        $labels = [];

        if (method_exists(static::class, 'getAllNames')) {
            $labels = static::getAllNames();
        }

        foreach (static::getAllValues() as $value) {
            $result[] = [
                'id' => $value,
                'label' => $labels[ $value ] ?? '',
            ];
        }

        return $result;
    }
}
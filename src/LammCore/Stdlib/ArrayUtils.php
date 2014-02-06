<?php

namespace LammCore\Stdlib;

use Zend\Stdlib\ArrayUtils as ZendArrayUtils;

abstract class ArrayUtils
{
    public static function objectToArray($data)
    {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = static::objectToArray($value);
            }

            return $result;
        }

        return $data;
    }

    public static function is_assoc($var)
    {
        return is_array($var) && array_diff_key($var,
                array_keys(array_keys($var)));
    }

    public static function is_sequential_array($var)
    {
        return (array_merge($var) === $var && is_numeric(implode(array_keys($var))) );
    }

    public static function merge($a, $b)
    {
        return ZendArrayUtils::merge($a, $b);
    }

    public static function orderKeysByKeys(array $values,array $keys)
    {
        if (empty($keys)) {
            Throw new \Exception("La Variable keys no puede estar vacia");
        }

        $tmpArray = array();
        foreach ($keys as $key) {
            if (array_key_exists($key,$values)) {
                $tmpArray[$key] = $values[$key];
            }
        }

        return $tmpArray;
    }

    public static function is_assoc_array($var)
    {
        return (array_merge($var) !== $var || !is_numeric(implode(array_keys($var))) );
    }

    public static function isVector($var)
    {
        return count(array_diff_key($var, range(0, count($var) - 1))) == 0;
    }

    public static function in_multiarray($elem, $array, $field)
    {
        foreach ($array as $key => $value) {
            if (!isset($value[$field])) {
                continue;
            }

            if ($value[$field] == $elem) {
                return true;
            } else {
                if(is_array($value[$field]))
                    if(static::in_multiarray($elem, ($value[$field])))

                        return true;
            }

        }

        return false;
    }

}

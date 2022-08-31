<?php

declare(strict_types=1);

/*
* This file is part of the bjoern-hempel/php-security-tools project.
*
* (c) Björn Hempel <https://www.hempel.li/>
*
* For the full copyright and license information, please view the LICENSE.md
* file that was distributed with this source code.
*/

namespace App\Utils\Converter;

/**
 * Class Array2String
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-31)
 * @package App\Utils\Converter
 */
class Array2String
{
    /**
     * Returns if array is associative.
     *
     * @param array<int|string, string|int|array<int, string>> $array
     * @return bool
     */
    public static function isArrayAssociative(array $array): bool
    {
        if (array() === $array) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Returns string from given value.
     *
     * @param string|int|array<int, string> $value
     * @return string
     */
    protected static function getString(int|string|array $value): string
    {
        return is_array($value) ? sprintf('[%s]', implode(',', $value)) : strval($value);
    }

    /**
     * Returns the text of an array.
     *
     * @param array<int|string, string|int|array<int, string>> $array
     * @return string
     */
    public static function getArrayText(array $array): string
    {
        $texts = [];

        if (self::isArrayAssociative($array)) {
            foreach ($array as $key => $value) {
                $texts[] = sprintf('%s = %s', $key, self::getString($value));
            }
        } else {
            foreach ($array as $value) {
                $texts[] = self::getString($value);
            }
        }

        return implode(', ', $texts);
    }
}
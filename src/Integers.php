<?php
/**
 * This file is a part of "paulorlima9/data-types" package.
 * https://github.com/paulorlima9/data-types
 *
 * Copyright (c) NEXUniverse <info@nexuniverse.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit following link:
 * https://github.com/paulorlima9/data-types/blob/master/LICENSE
 */

declare(strict_types=1);

namespace DataTypes;

/**
 * Class Integers
 * @package DataTypes
 */
class Integers
{
    /**
     * @param int $num
     * @param int $from
     * @param int $to
     * @return bool
     */
    public static function Range(int $num, int $from, int $to): bool
    {
        return ($num >= $from && $num <= $to);
    }
}

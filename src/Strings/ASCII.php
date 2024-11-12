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

namespace DataTypes\Strings;

use DataTypes\Buffer\Base16;
use DataTypes\DataTypes;

/**
 * Class ASCII
 * @package DataTypes\Strings
 */
class ASCII
{
    /**
     * @param string $ascii
     * @return Base16
     */
    public static function base16Encode(string $ascii): Base16
    {
        if (DataTypes::isUtf8($ascii)) {
            throw new \InvalidArgumentException('Cannot encode UTF-8 string into hexadecimals');
        }

        $hex = "";
        for ($i = 0; $i < strlen($ascii); $i++) {
            $hex .= str_pad(dechex(ord($ascii[$i])), 2, "0", STR_PAD_LEFT);
        }

        return new Base16($hex);
    }

    /**
     * @param Base16 $hex
     * @return string
     */
    public static function base16Decode(Base16 $hex): string
    {
        $hex = $hex->hexits();
        $str = "";
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $str .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }

        return $str;
    }
}
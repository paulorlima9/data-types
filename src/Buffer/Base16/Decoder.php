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

namespace DataTypes\Buffer\Base16;

use DataTypes\BcMath\BcMath;
use DataTypes\BcNumber;
use DataTypes\Buffer\Base16;
use DataTypes\Buffer\Binary;
use DataTypes\Buffer\Bitwise;
use DataTypes\Strings\ASCII;

/**
 * Class Decoder
 * @package DataTypes\Buffer\Base16
 */
class Decoder
{
    /** @var Base16 */
    private $buffer;

    /**
     * Decoder constructor.
     * @param Base16 $buffer
     */
    public function __construct(Base16 $buffer)
    {
        $this->buffer = $buffer;
    }

    /**
     * @return BcNumber
     */
    public function base10(): BcNumber
    {
        return BcNumber::fromBase16($this->buffer);
    }

    /**
     * @return BcNumber
     */
    public function int(): BcNumber
    {
        return $this->base10();
    }

    /**
     * @return string
     */
    public function ascii(): string
    {
        return ASCII::base16Decode($this->buffer);
    }

    /**
     * @return Binary
     */
    public function binary(): Binary
    {
        return $this->buffer->binary();
    }

    /**
     * @return Bitwise
     */
    public function bitwise(): Bitwise
    {
        $hexits = $this->buffer->value();
        if (!$hexits) {
            throw new \UnexpectedValueException('Base16 buffer is NULL or empty');
        }

        // Make sure nibbles are even
        if (strlen($hexits) % 2 !== 0) {
            $hexits = "0" . $hexits;
        }

        $expectedBits = strlen($hexits) * 4;
        $bitwise = BcMath::BaseConvert($hexits, 16, 2);
        if (strlen($bitwise) < $expectedBits) {
            $bitwise = str_repeat("0", $expectedBits - strlen($bitwise)) . $bitwise;
        }

        return new Bitwise($bitwise);
    }
}

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

namespace DataTypes\Buffer\Binary;

use DataTypes\Buffer\Binary;

/**
 * Class LenSize
 * @package DataTypes\Buffer\Binary
 */
class LenSize
{
    /** @var Binary */
    private $buffer;

    /**
     * LenSize constructor.
     * @param Binary $binary
     */
    public function __construct(Binary $binary)
    {
        $this->buffer = $binary;
    }

    /**
     * @return int
     */
    public function len(): int
    {
        return $this->buffer->length;
    }

    /**
     * @return int
     */
    public function bytes(): int
    {
        return $this->buffer->sizeInBytes;
    }

    /**
     * @return int
     */
    public function bits(): int
    {
        return $this->buffer->sizeInBytes * 8;
    }
}
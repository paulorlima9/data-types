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

namespace DataTypes\Buffer;

use DataTypes\Buffer\Base16\Decoder;
use DataTypes\DataTypes;

/**
 * Class Base16
 * @package DataTypes\Buffer
 */
class Base16 extends AbstractBuffer
{
    /** @var Decoder */
    private $decoder;

    /**
     * @param string|null $data
     * @return string
     */
    public function validatedDataTypeValue(?string $data): string
    {
        if (!DataTypes::isBase16($data)) {
            throw new \InvalidArgumentException('First argument must be a Hexadecimal value');
        }

        // Remove "0x" prefix
        if (substr($data, 0, 2) === "0x") {
            $data = substr($data, 2);
        }

        // Even-out uneven number of hexits
        if (strlen($data) % 2 !== 0) {
            $data = "0" . $data;
        }

        return $data;
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return [
            "data" => $this->hexits(true),
            "len" => $this->len()
        ];
    }

    /**
     * @param bool $prefix
     * @return string
     */
    public function hexits(bool $prefix = false): string
    {
        $hexits = $this->value() ?? "";
        if ($hexits && $prefix) {
            return "0x" . $hexits;
        }

        return $hexits;
    }

    /**
     * @return Binary
     */
    public function binary(): Binary
    {
        return new Binary(hex2bin($this->hexits(false)));
    }

    /**
     * @return Decoder
     */
    public function decode(): Decoder
    {
        if (!$this->decoder) {
            $this->decoder = new Decoder($this);
        }

        return $this->decoder;
    }
}
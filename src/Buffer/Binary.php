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

use DataTypes\Buffer\Binary\ByteReader;
use DataTypes\Buffer\Binary\Digest;
use DataTypes\Buffer\Binary\LenSize;

/**
 * Class Binary
 * @package DataTypes\Buffer
 */
class Binary extends AbstractBuffer
{
    /** @var LenSize */
    private $lenSize;

    /**
     * @param string|null $data
     * @return string
     */
    public function validatedDataTypeValue(?string $data): string
    {
        return $data ?? "";
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return [
            "data" => "0x" . bin2hex($this->raw()),
            "size" => $this->size()->bytes(),
            "bits" => $this->size()->bits()
        ];
    }

    /**
     * @return string
     */
    public function raw(): string
    {
        return $this->value() ?? "";
    }

    /**
     * @return LenSize
     */
    public function size(): LenSize
    {
        if (!$this->lenSize) {
            $this->lenSize = new LenSize($this);
        }

        return $this->lenSize;
    }

    /**
     * @return Base16
     */
    public function base16(): Base16
    {
        return new Base16(bin2hex($this->raw()));
    }

    /**
     * @return Base64
     */
    public function base64(): Base64
    {
        return new Base64(base64_encode($this->raw()));
    }

    /**
     * @return Bitwise
     */
    public function bitwise(): Bitwise
    {
        return $this->base16()->decode()->bitwise();
    }

    /**
     * @return Digest
     */
    public function hash(): Digest
    {
        return new Digest($this);
    }

    /**
     * @return ByteReader
     */
    public function read(): ByteReader
    {
        return new ByteReader($this);
    }
}
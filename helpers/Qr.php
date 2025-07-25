<?php

namespace app\helpers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

/**
 * Операции с QR-кодом
 */
class Qr
{
    /**
    * Генерировать QR-код из текста
    *
    * @param string $value - текст
    */
    public static function get(string $value)
    {
        return (new PngWriter())->write(new QrCode($value));
    }
}

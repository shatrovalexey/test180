<?php

namespace app\helpers;

/**
 * Операции с URL
 */
class Url
{
    /**
    * Конструктор
    *
    * @param string $origin
    */
    public function __construct(protected string $origin) { }

    /**
    * Составить URL
    *
    * @param string $alias
    * @param string $path
    *
    * @return string
    */
    protected function _get(string $alias, string $path): string
    {
        return implode('/', [$this->origin, $path, $alias,]);
    }

    /**
    * Составить URL из alias для редиректа по href
    *
    * @param string $alias
    * @param string $path
    *
    * @return string
    */
    public function getAlias(string $alias, string $path = 'api/url'): string
    {
        return static::_get($alias, $path);
    }

    /**
    * Составить URL для QR из alias
    *
    * @param string $alias
    * @param string $path
    *
    * @return string
    */
    public function getQr(string $alias, string $path = 'api/qr'): string
    {
        return static::_get($alias, $path);
    }
}

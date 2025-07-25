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
    protected function _getUrl(string $alias, string $path): string
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
    public function getAliasUrl(string $alias, string $path = 'api/url'): string
    {
        return static::_getUrl($alias, $path);
    }

    /**
    * Составить URL для QR из alias
    *
    * @param string $alias
    * @param string $path
    *
    * @return string
    */
    public function getQrUrl(string $alias, string $path = 'api/qr'): string
    {
        return static::_getUrl($alias, $path);
    }
}

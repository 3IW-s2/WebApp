<?php

namespace App\Core\Configuration;

class AppConfiguration extends Configuration
{
    public static function getAppConfig(): array
    {
        return self::getConfig("APP");
    }
}
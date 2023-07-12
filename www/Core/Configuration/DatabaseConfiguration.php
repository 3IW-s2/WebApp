<?php

namespace App\Core\Configuration;

class DatabaseConfiguration extends Configuration
{
    public static function getDatabaseConfig(): array
    {
        return self::getConfig("DB");
    }

    public static function getInitFile(): string
    {
        $sql = file_get_contents( __DIR__."/sql/init.sql");
        return str_replace("{DB_PREFIX}", self::getDatabaseConfig()["DB_PREFIX"]."_", $sql);
    }
}
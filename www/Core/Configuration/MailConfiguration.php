<?php

namespace App\Core\Configuration;

class MailConfiguration extends Configuration
{
    public static function getMailConfig(): array
    {
        return self::getConfig("MAIL");
    }
}
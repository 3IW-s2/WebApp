<?php

namespace App\Core\Configuration;

class DatabaseConfiguration
{
    // get database conf values in .env
    public static function getDatabaseConfig(): array
    {
        $env = [];
        $valuesWithDependantValues = [];
        $configuration = file($_SERVER['DOCUMENT_ROOT']."/.env.example");
        foreach ($configuration as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === "#") {
                continue;
            }
            $keyValue = explode("=", $line);
            $key = trim($keyValue[0]);
            $value = trim($keyValue[1]);

            if (preg_match('/\${(.*?)}/', $value)) {
                $dependantKey[$key] = $value;
                continue;
            }

            if(is_numeric($value)){
                $value = is_float($value + 0)
                    ? (float)(trim($keyValue[1]))
                    : (int)(trim($keyValue[1]));
            }


            if(is_string($value)){
                // remove start and end quotes
                $value = trim($value, '"');

                if ($value === "null") {
                    $value = null;
                }

                if($value === "true" || $value === "false"){
                    $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                }
            }


            $env[$key] = $value;
        }

        if(!empty($dependantKey)){
            foreach ($dependantKey as $valueName => $value) {
                preg_match_all('/\${(.*?)}/', $value, $matches);
                foreach ($matches[0] as $key => $match) {
                    if(isset($env[$matches[1][$key]])){
                        $value = str_replace($match, $env[$matches[1][$key]], $value);
                    }
                }

                $env[$valueName] = trim(trim($value, '"'));
            }
        }

        return $env;
    }
}
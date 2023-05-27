<?php
namespace App\Core;

class Error
{
    private $errors = [];

    public function addError(string $errorMessage): void
    {
        $this->errors[] = $errorMessage;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

     public function hasErrors(): bool
    {
        return !empty($this->errors);
    } 

    public function setCode (int $code): void
    {
        http_response_code($code);
    }
}

<?php

namespace App\Validator;

class RequestValidator
{
    public function __construct(private readonly array $config = [])
    {
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}

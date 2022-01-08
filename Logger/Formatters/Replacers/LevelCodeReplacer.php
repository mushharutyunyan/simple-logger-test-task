<?php

namespace Logger\Formatters\Replacers;

use Logger\LogLevel;

class LevelCodeReplacer implements IReplacer
{
    public const DEFAULT_CODE = LogLevel::INFO['code'];

    protected string $code;

    public function __construct(?string $code = null)
    {
        $this->code = $code ?? self::DEFAULT_CODE;
    }

    public function replace(string $message): string
    {
        return preg_replace('@%level_code%@', $this->code, $message);
    }
}
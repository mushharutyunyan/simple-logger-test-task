<?php

namespace Logger\Formatters\Replacers;

use Logger\LogLevel;

class LevelReplacer implements IReplacer
{
    public const DEFAULT_LEVEL = LogLevel::INFO['name'];

    protected string $level;

    public function __construct(?string $level = null)
    {
        $this->level = $level ?? self::DEFAULT_LEVEL;
    }

    public function replace(string $message): string
    {
        return preg_replace('@%level%@', $this->level, $message);
    }
}
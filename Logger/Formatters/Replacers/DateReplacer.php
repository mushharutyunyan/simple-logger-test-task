<?php

namespace Logger\Formatters\Replacers;

class DateReplacer implements IReplacer
{
    public const DEFAULT_DATE_FORMAT = "Y-m-d H:i:s";

    protected string $dateFormat;

    public function __construct(?string $dateFormat)
    {
        $this->dateFormat = $dateFormat ?? self::DEFAULT_DATE_FORMAT;
    }

    public function replace(string $message): string
    {
        return preg_replace('@%date%@', date($this->dateFormat, strtotime('now')), $message);
    }
}
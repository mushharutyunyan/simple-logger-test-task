<?php

namespace Logger\Formatters;

use Logger\Collection\Collection;

interface ILineFormatter
{
    public function __construct(?string $format = null, ?string $dateFormat = null);
    public function formatMessage(string $message, Collection $level): string;
    public function generateFormatters(string $message, Collection $level): void;
    public function replaceMessage(): string;
}
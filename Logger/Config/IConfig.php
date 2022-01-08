<?php

namespace Logger\Config;

use Logger\Collection\Collection;
use Logger\Formatters\ILineFormatter;

interface IConfig
{
    public function isEnabled(): bool;
    public function getFileName(): ?string;
    public function getLevels(): ?Collection;
    public function getFormatter(): ILineFormatter;
    public function checkAllowedLoggingByLevel(Collection $level): bool;
}
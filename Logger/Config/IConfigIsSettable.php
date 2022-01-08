<?php

namespace Logger\Config;

use Logger\Collection\Collection;
use Logger\Formatters\ILineFormatter;

interface IConfigIsSettable
{
    public function setFilename(string $filename): void;
    public function setIsEnabled(bool $isEnabled): void;
    public function setLevels(array $levels): void;
    public function setLevel(Collection $level): void;
    public function setFormatter(ILineFormatter $formatter): void;
}
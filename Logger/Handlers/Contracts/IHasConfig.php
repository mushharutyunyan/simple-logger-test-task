<?php

namespace Logger\Handlers\Contracts;

use Logger\Config\IConfig;

interface IHasConfig
{
    public function __construct(IConfig $config);
    public function isEnabled(): bool;
    public function setIsEnabled(bool $enabled): void;
}
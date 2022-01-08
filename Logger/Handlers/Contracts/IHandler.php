<?php

namespace Logger\Handlers\Contracts;

use Logger\Collection\Collection;

interface IHandler extends IDebug, INotice, IError, IInfo
{
    public function log(Collection $level, string $message): void;
    public function checkAllowedTypeOfLog(Collection $level): bool;
}
<?php

namespace Logger\Handlers;

use Logger\Collection\Collection;
use Logger\Handlers\Contracts\IHandler;

class FakeHandler implements IHandler
{
    public function log(Collection $level, string $message): void
    {
        // TODO: Implement log() method.
    }

    public function checkAllowedTypeOfLog(Collection $level): bool
    {
        return false;
    }

    public function notice(string $message)
    {
        // TODO: Implement notice() method.
    }

    public function debug(string $message)
    {
        // TODO: Implement debug() method.
    }

    public function error(string $message)
    {
        // TODO: Implement error() method.
    }

    public function info(string $message)
    {
        // TODO: Implement info() method.
    }
}
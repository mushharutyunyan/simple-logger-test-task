<?php

namespace Logger;

use Logger\Collection\Collection;
use Logger\Handlers\Contracts\IDebug;
use Logger\Handlers\Contracts\IError;
use Logger\Handlers\Contracts\IHandler;
use Logger\Handlers\Contracts\IHasConfig;
use Logger\Handlers\Contracts\IInfo;
use Logger\Handlers\Contracts\INotice;

class Logger implements IDebug, INotice, IInfo, IError
{
    private Collection $handlers;

    public function __construct()
    {
        $this->handlers = new Collection();
    }

    public function log(Collection $level, string $message)
    {
        $this->handlers->map(function ($item) use ($level, $message) {
            /** @var IHandler|IHasConfig $item */
            if($item instanceof IHasConfig && $item->isEnabled() && $item->checkAllowedTypeOfLog($level)){
                $item->log($level, $message);
            }
        });
    }

    public function addHandler(IHandler $handler)
    {
        $this->handlers->add($handler);
    }

    public function error(string $message)
    {
        $this->log(new Collection(LogLevel::ERROR), $message);
    }

    public function info(string $message)
    {
        $this->log(new Collection(LogLevel::INFO), $message);
    }

    public function notice(string $message)
    {
        $this->log(new Collection(LogLevel::NOTICE), $message);
    }

    public function debug(string $message)
    {
        $this->log(new Collection(LogLevel::DEBUG), $message);
    }
}
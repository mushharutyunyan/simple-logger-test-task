<?php

namespace Logger\Handlers;

use Logger\Collection\Collection;
use Logger\Config\IConfig;
use Logger\Handlers\Contracts\IHandler;
use Logger\Handlers\Contracts\IHasConfig;

class FileHandler implements IHandler, IHasConfig
{
    private IConfig $config;

    public function __construct(IConfig $config)
    {
        $this->config = $config;
    }

    public function log(Collection $level, string $message): void
    {
        $oldMessage = @file_get_contents($this->config->getFileName()) ?: '';
        if($oldMessage){
            $oldMessage .= "\n";
        }
        file_put_contents($this->config->getFileName(), $oldMessage .= $this->config->getFormatter()->formatMessage($message, $level));
    }

    public function checkAllowedTypeOfLog(Collection $level): bool
    {
        return $this->config->checkAllowedLoggingByLevel($level);
    }

    public function isEnabled(): bool
    {
        return $this->config->isEnabled();
    }

    public function debug(string $message)
    {
        $this->log(new Collection(LogLevel::DEBUG), $message);
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

    public function setIsEnabled(bool $enabled): void
    {
        $this->config->setIsEnabled($enabled);
    }
}
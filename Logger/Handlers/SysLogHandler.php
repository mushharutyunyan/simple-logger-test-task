<?php

namespace Logger\Handlers;

use Logger\Collection\Collection;
use Logger\Config\IConfig;
use Logger\Handlers\Contracts\IHandler;
use Logger\Handlers\Contracts\IHasConfig;

class SysLogHandler implements IHandler, IHasConfig
{
    private IConfig $config;

    public const TRANSFORM_NAMES = [
        'ERROR' => 'ERR'
    ];

    public function __construct(IConfig $config)
    {
        $this->config = $config;
    }

    public function log(Collection $level, string $message): void
    {
        $levelName = strtoupper($level->get('name'));
        if(isset(self::TRANSFORM_NAMES[$levelName])){
            $levelName = self::TRANSFORM_NAMES[$levelName];
        }
        syslog(constant('LOG_' . $levelName), $this->config->getFormatter()->formatMessage($message, $level));
    }

    public function isEnabled(): bool
    {
        return $this->config->isEnabled();
    }

    public function checkAllowedTypeOfLog(Collection $level): bool
    {
        return $this->config->checkAllowedLoggingByLevel($level);
    }

    public function setIsEnabled(bool $enabled): void
    {
        $this->config->setIsEnabled($enabled);
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
}
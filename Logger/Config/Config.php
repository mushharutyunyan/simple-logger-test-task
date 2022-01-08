<?php

namespace Logger\Config;

use Logger\Collection\Collection;
use Logger\Formatters\ILineFormatter;
use Logger\Formatters\LineFormatter;

class Config implements IConfig, IConfigIsSettable
{
    private bool $isEnabled;
    private Collection $levels;
    private ILineFormatter $formatter;
    private ?string $filename;

    public function __construct(bool $isEnabled, ?string $filename = null, array $levels = [], ?ILineFormatter $formatter = null)
    {
        $this->isEnabled = $isEnabled;
        $this->filename = $filename;
        $this->formatter = $formatter ?? new LineFormatter();
        $this->levels = new Collection();
        $this->setLevels($levels);
    }

    public function getFormatter(): ILineFormatter
    {
        return $this->formatter;
    }

    public function checkAllowedLoggingByLevel(Collection $level): bool
    {
        return (bool) $this->levels->filter(function ($item) use ($level){
            /** @var $item Collection */
            return $item->get('code') === $level->get('code');
        })->first();
    }

    public function setFormatter(ILineFormatter $formatter): void
    {
        $this->formatter = $formatter;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public function getLevels(): ?Collection
    {
        return $this->levels;
    }

    public function setLevels(array $levels): void
    {
        foreach ($levels as $level){
            $this->setLevel(new Collection($level));
        }
    }

    public function setLevel(Collection $level): void
    {
        $this->levels->add($level);
    }
}
<?php

namespace Logger\Formatters\Replacers;

class MessageReplacer implements IReplacer
{
    protected string $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;
    }

    public function replace(string $message): string
    {
        return preg_replace('@%message%@', $this->message, $message);
    }
}
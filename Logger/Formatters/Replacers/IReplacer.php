<?php

namespace Logger\Formatters\Replacers;

interface IReplacer
{
    public function replace(string $message): string;
}
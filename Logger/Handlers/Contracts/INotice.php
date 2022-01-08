<?php

namespace Logger\Handlers\Contracts;

interface INotice
{
    public function notice(string $message);
}
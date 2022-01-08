<?php

namespace Logger\Handlers\Contracts;

interface IError
{
    public function error(string $message);
}
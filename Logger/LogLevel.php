<?php

namespace Logger;

/**
 * For 8.1 can use enums
 */
class LogLevel
{
    const ERROR    = [
        'name' => 'Error',
        'code' => '001'
    ];
    const INFO      = [
        'name' => 'Info',
        'code' => '002'
    ];
    const DEBUG     = [
        'name' => 'Debug',
        'code' => '003'
    ];
    const NOTICE    = [
        'name' => 'Notice',
        'code' => '004'
    ];
}
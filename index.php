<?php

include_once __DIR__ . '/autoload/autoload.php';

use Logger\Collection\Collection;
use Logger\Handlers\FileHandler;
use Logger\Config\Config;
use Logger\LogLevel;
use Logger\Formatters\LineFormatter;
use Logger\Handlers\SysLogHandler;
use Logger\Handlers\FakeHandler;

$as = new Logger\Logger();

$fileHandler = new FileHandler(
    new Config(
        true,
        __DIR__ . '/application.info.log',
        [
            LogLevel::INFO
        ],
        new LineFormatter(
    '%date%  [%level_code%]  [%level%]  %message%',
    'Y-m-d\TH:i:sP'
        )
    )
);

$as->addHandler($fileHandler);
$as->addHandler(new FakeHandler());
$as->addHandler(new FileHandler(
    new Config(
        true,
        __DIR__ . '/application.debug.log',
        [
            LogLevel::DEBUG
        ],
    )
));

$as->log(new Collection(LogLevel::DEBUG), 'dasdasdas');
$as->error('Araaaa');

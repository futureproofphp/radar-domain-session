<?php
use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Cadre\DomainSession\SessionManager;
use Cadre\DomainSession\Storage\Files;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Config extends ContainerConfig
{
    public function define(Container $di)
    {
        $di->set('logger', $di->lazyNew(Logger::class));

        $di->params[Logger::class] = [
            'name' => 'Radar',
        ];

        $di->setters[Logger::class] = [
            'pushHandler' => $di->lazyNew(StreamHandler::class),
        ];

        $di->params[StreamHandler::class] = [
            'stream' => __DIR__ . '/../debug.log',
            'level' => Logger::DEBUG,
        ];

        $di->params[Files::class] = [
            'path' => realpath(__DIR__ . '/../sessions/'),
            'expiresInterval' => 'PT10S',
        ];

        $di->setters[Files::class] = [
            'setLogger' => $di->lazyGet('logger'),
        ];

        $di->params[SessionManager::class] = [
            'storage' => $di->lazyNew(Files::class),
        ];

        $di->setters[SessionManager::class] = [
            'setLogger' => $di->lazyGet('logger'),
        ];

        $di->params[Sample::class] = [
            'manager' => $di->lazyNew(SessionManager::class),
        ];
    }
}

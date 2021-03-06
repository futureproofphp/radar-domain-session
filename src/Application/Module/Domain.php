<?php
declare(strict_types=1);

namespace Application\Module;

use Application\Domain\Home;
use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Cadre\DomainSession\SessionManager;
use Cadre\DomainSession\Storage\Files;

class Domain extends ContainerConfig
{
    public function define(Container $di)
    {
        $di->params[Files::class] = [
            'path' => __ROOTDIR__ . '/sessions',
        ];

        $di->params[SessionManager::class] = [
            'storage' => $di->lazyNew(Files::class),
        ];

        $di->params[Home::class] = [
            'sessionManager' => $di->lazyNew(SessionManager::class),
        ];
    }
}

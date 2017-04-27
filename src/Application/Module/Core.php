<?php
declare(strict_types=1);

namespace Application\Module;

use Application\Delivery\DefaultInput;
use Application\Delivery\DefaultResponder;
use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Radar\Adr\Handler\RoutingHandler;
use Radar\Adr\Handler\ActionHandler;
use Relay\Middleware\ExceptionHandler;
use Relay\Middleware\ResponseSender;
use Zend\Diactoros\Response;

class Core extends ContainerConfig
{
    public function define(Container $di)
    {
        /** DefaultResponder */

        $di->params[DefaultResponder::class] = [
            'twig' => $di->lazyGet('twig:environment'),
            'debugbar' => null,
        ];

        /** ExceptionHandler */

        $di->params[ExceptionHandler::class] = [
            'exceptionResponse' => $di->lazyNew(Response::class),
        ];
    }

    public function modify(Container $di)
    {
        $adr = $di->get('radar/adr:adr');

        $adr->middle(ResponseSender::class);
        $adr->middle(ExceptionHandler::class);
        $adr->middle(RoutingHandler::class);
        $adr->middle(ActionHandler::class);

        $adr->input(DefaultInput::class);
        $adr->responder(DefaultResponder::class);
    }
}

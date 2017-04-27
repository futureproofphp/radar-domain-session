<?php
use Application\Module\Core as CoreModule;
use Application\Module\Domain as DomainModule;
use Application\Module\Routing as RoutingModule;
use Application\Module\Twig as TwigModule;
use Radar\Adr\Boot;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory as Request;

require '../vendor/autoload.php';

date_default_timezone_set('UTC');
define('__ROOTDIR__', realpath(__DIR__ . '/../'));

$boot = new Boot();
$adr = $boot->adr([
    CoreModule::class,
    DomainModule::class,
    RoutingModule::class,
    TwigModule::class,
]);

$adr->run(Request::fromGlobals(), new Response());

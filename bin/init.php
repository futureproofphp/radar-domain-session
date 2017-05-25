<?php
use Application\Module\Domain as DomainModule;
use Aura\Di\ContainerBuilder;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory as Request;

require '../vendor/autoload.php';

date_default_timezone_set('UTC');
define('__ROOTDIR__', realpath(__DIR__ . '/../'));

$builder = new ContainerBuilder();
$di = $builder->newConfiguredInstance([
    DomainModule::class,
]);

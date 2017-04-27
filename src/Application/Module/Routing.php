<?php
declare(strict_types=1);

namespace Application\Module;

use Application\Delivery\HomeInput;
use Application\Delivery\HomeResponder;
use Application\Domain\Home;
use Aura\Di\Container;
use Aura\Di\ContainerConfig;

class Routing extends ContainerConfig
{
    public function modify(Container $di)
    {
        $adr = $di->get('radar/adr:adr');

        $adr->get('Home', '/', Home::class)
            ->defaults(['_view' => 'home.html.twig']);

        // $adr->get('Home', '/', function () {
        //     return ['success' => true];
        // })->defaults(['_view' => 'home.html.twig']);
    }
}

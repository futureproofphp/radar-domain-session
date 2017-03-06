<?php
namespace Sample;

use Aura\Payload_Interface\PayloadInterface;
use Aura\Payload\Payload;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\SetCookie;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Responder
{
    public function __invoke(
        Request $request,
        Response $response,
        PayloadInterface $payload = null
    ) {
        $session = $payload->getOutput();

        if ($session->getId()->hasUpdatedValue()) {
            $response = FigResponseCookies::set(
                $response,
                SetCookie::create('PHP_SESSION')
                    ->withValue($session->getId()->value())
            );
        }

        $response = $response->withHeader('Content-Type', 'text/plain');
        $response->getBody()->write($session->lastTimestamp);

        return $response;
    }
}

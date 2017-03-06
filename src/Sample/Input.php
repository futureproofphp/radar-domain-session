<?php
namespace Sample;

use Psr\Http\Message\ServerRequestInterface as Request;

class Input
{
    public function __invoke(Request $request)
    {
        $cookies = $request->getCookieParams();

        $id = $cookies['PHP_SESSION'] ?? null;

        return [$id];
    }
}

<?php
declare(strict_types = 1);

require __DIR__.'/../vendor/autoload.php';

use Innmind\HttpServer\Main;
use Innmind\Http\Message\{
    ServerRequest,
    Response,
    StatusCode,
};

new class extends Main
{
    protected function main(ServerRequest $request): Response
    {
        //echo back server
        return new Response\Response(
            StatusCode::ok,
            $request->protocolVersion(),
            null,
            $request->body(),
        );
    }
};

<?php
declare(strict_types = 1);

require __DIR__.'/../vendor/autoload.php';

use Innmind\HttpServer\Main;
use Innmind\Http\Message\{
    ServerRequest,
    Response,
    StatusCode\StatusCode,
};
use Innmind\OperatingSystem\OperatingSystem;

new class extends Main
{
    protected function main(ServerRequest $request, OperatingSystem $os): Response
    {
        //echo back server
        return new Response\Response(
            $code = StatusCode::of('OK'),
            $code->associatedReasonPhrase(),
            $request->protocolVersion(),
            null,
            $request->body()
        );
    }
};

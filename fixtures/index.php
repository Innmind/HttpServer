<?php
declare(strict_types = 1);

require __DIR__.'/../vendor/autoload.php';

use Innmind\HttpServer\Main;
use Innmind\Http\{
    ServerRequest,
    Response,
    Response\StatusCode,
};
use Innmind\Filesystem\File\Content;

new class extends Main
{
    protected function main(ServerRequest $request): Response
    {
        // Echo back server
        return Response::of(
            StatusCode::ok,
            $request->protocolVersion(),
            null,
            Content::ofString('Hello world'),
        );
    }
};

<?php
declare(strict_types = 1);

namespace Innmind\HttpServer;

use Innmind\Http\{
    Factory\ServerRequest\ServerRequestFactory,
    Sender,
    ResponseSender,
    ServerRequest,
    ServerRequest\Environment,
    Response,
    Response\StatusCode,
    ProtocolVersion,
    Exception\DomainException,
};
use Innmind\Filesystem\File\Content;
use Innmind\OperatingSystem\{
    Factory,
    OperatingSystem,
    Config,
};

abstract class Main
{
    final public function __construct(Config $config = null)
    {
        $os = Factory::build($config);
        $makeRequest = ServerRequestFactory::default($os->clock());
        $send = new ResponseSender($os->clock());

        try {
            $request = $makeRequest();
        } catch (DomainException $e) {
            $send($this->badRequest());

            return;
        }

        $this->preload($os, $request->environment());

        try {
            $response = $this->main($request);
        } catch (\Throwable $e) {
            $response = $this->serverError($request);
        }

        $send($response);

        $this->terminate($request, $response);
    }

    /**
     * Use this method to build the app
     *
     * Exceptions that occured in this method will not be caught and may so be
     * rendered to the client. This is the expected behaviour so it's easier to
     * watch errors when developping the app. This method should never throw an
     * exception when in production mode.
     */
    protected function preload(OperatingSystem $os, Environment $env): void
    {
    }

    abstract protected function main(ServerRequest $request): Response;

    protected function terminate(ServerRequest $request, Response $response): void
    {
    }

    private function badRequest(): Response
    {
        return Response::of(
            StatusCode::badRequest,
            ProtocolVersion::v10,
            null,
            Content::ofString('Request doesn\'t respect HTTP protocol'),
        );
    }

    private function serverError(ServerRequest $request): Response
    {
        return Response::of(
            StatusCode::internalServerError,
            $request->protocolVersion(),
        );
    }
}

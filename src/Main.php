<?php
declare(strict_types = 1);

namespace Innmind\HttpServer;

use Innmind\Http\{
    Factory\ServerRequestFactory as ServerRequestFactoryInterface,
    Factory\ServerRequest\ServerRequestFactory,
    Sender,
    ResponseSender,
    Message\ServerRequest,
    Message\Environment,
    Message\Response,
    Message\StatusCode\StatusCode,
    ProtocolVersion\ProtocolVersion,
    Exception\DomainException,
};
use Innmind\Filesystem\Stream\StringStream;
use Innmind\TimeContinuum\TimeContinuumInterface;
use Innmind\OperatingSystem\{
    Factory,
    OperatingSystem,
};

abstract class Main
{
    final public function __construct(
        ServerRequestFactoryInterface $factory = null,
        Sender $send = null,
        OperatingSystem $os = null
    ) {
        $os = $os ?? Factory::build();
        $factory = $factory ?? ServerRequestFactory::default();
        $send = $send ?? new ResponseSender($os->clock());

        try {
            $request = $factory->make();
        } catch (DomainException $e) {
            $send($this->badRequest());

            return;
        }

        $this->preload($os, $request->environment());

        try {
            $response = $this->main($request, $os);
        } catch (\Throwable $e) {
            $response = $this->serverError($request);
        }

        $send($response);

        $this->terminate($request, $response);
    }

    /**
     * Use this method to build the app
     *
     * Exceptions that occured in this method will not be called and may so be
     * rendered to the client. This is the expected behaviour so it's easier to
     * watch errors when developping the app. This method should never throw an
     * exception when in production mode, the bootstrap of your app must be
     * "pure" (in FP terms)
     */
    protected function preload(OperatingSystem $os, Environment $env): void
    {
    }

    abstract protected function main(ServerRequest $request, OperatingSystem $os): Response;

    protected function terminate(ServerRequest $request, Response $response): void
    {
    }

    private function badRequest(): Response
    {
        return new Response\Response(
            $code = StatusCode::of('BAD_REQUEST'),
            $code->associatedReasonPhrase(),
            new ProtocolVersion(1, 0),
            null,
            new StringStream('Request doesn\'t respect HTTP protocol')
        );
    }

    private function serverError(ServerRequest $request) : Response
    {
        return new Response\Response(
            $code = StatusCode::of('INTERNAL_SERVER_ERROR'),
            $code->associatedReasonPhrase(),
            $request->protocolVersion()
        );
    }
}

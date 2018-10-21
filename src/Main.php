<?php
declare(strict_types = 1);

namespace Innmind\HttpServer;

use Innmind\Http\{
    Factory\ServerRequestFactory as ServerRequestFactoryInterface,
    Factory\ServerRequest\ServerRequestFactory,
    Sender,
    ResponseSender,
    Message\ServerRequest,
    Message\Response,
    Message\StatusCode\StatusCode,
    ProtocolVersion\ProtocolVersion,
    Exception\DomainException,
};
use Innmind\Filesystem\Stream\StringStream;
use Innmind\TimeContinuum\TimeContinuum\Earth;
use Innmind\OperatingSystem\{
    Factory,
    OperatingSystem,
};

abstract class Main
{
    final public function __construct(
        ServerRequestFactoryInterface $factory = null,
        Sender $send = null,
        TimeContinuumInterface $clock = null
    ) {
        $clock = $clock ?? new Earth;
        $factory = $factory ?? ServerRequestFactory::default();
        $send = $send ?? new ResponseSender($clock);
        $os = Factory::build($clock);

        try {
            $request = $factory->make();
        } catch (DomainException $e) {
            $send($this->badRequest());

            return;
        }

        try {
            $response = $this->main($request, $os);
        } catch (\Throwable $e) {
            $response = $this->serverError($request);
        }

        $send($response);

        $this->terminate($request, $response);
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

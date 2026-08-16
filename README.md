# Http Server

[![CI](https://github.com/Innmind/HttpServer/actions/workflows/ci.yml/badge.svg)](https://github.com/Innmind/HttpServer/actions/workflows/ci.yml)
[![Type Coverage](https://shepherd.dev/github/innmind/httpserver/coverage.svg)](https://shepherd.dev/github/innmind/httpserver)

Entry point to build an HTTP server.

## Installation

```sh
composer require innmind/http-server
```

## Usage

```php
require 'vendor/autoload.php';

use Innmind\HttpServer\Main;
use Innmind\Http\{
    ServerRequest,
    Response,
};
use Innmind\OperatingSystem\OperatingSystem;
use Innmind\Immutable\Map;

new class extends Main {
    /**
     * @param Map<string, string> $env
     */
    protected function preload(OperatingSystem $os, Map $env): void
    {
        // optional, use this method to boostrap your app
    }

    protected function main(ServerRequest $request): Response
    {
        // handle the request here
    }
};
```

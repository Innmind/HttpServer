# Http Server

[![Build Status](https://github.com/Innmind/HttpServer/workflows/CI/badge.svg)](https://github.com/Innmind/HttpServer/actions?query=workflow%3ACI)
[![Type Coverage](https://shepherd.dev/github/Innmind/HttpServer/coverage.svg)](https://shepherd.dev/github/Innmind/HttpServer)

Entry point to build an HTTP server.

## Installation

```sh
composer require innmind/http-server
```

## Usage

```php
require 'vendor/autoload.php';

use Innmind\HttpServer\Main;
use Innmind\Http\Message\{
    ServerRequest,
    Response,
    Environment,
};
use Innmind\OperatingSystem\OperatingSystem;

new class extends Main {
    protected function preload(OperatingSystem $os, Environment $env): void
    {
        // optional, use this method to boostrap your app
    }

    protected function main(ServerRequest $request): Response
    {
        // handle the request here
    }
};
```

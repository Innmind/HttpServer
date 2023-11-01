# Http Server

[![Build Status](https://github.com/innmind/httpserver/workflows/CI/badge.svg?branch=master)](https://github.com/innmind/httpserver/actions?query=workflow%3ACI)
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
    ServerRequest\Environment,
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

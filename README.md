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
};
use Innmind\OperatingSystem\OperatingSystem;

new class extends Main {
    protected function main(ServerRequest $request, OperatingSystem $os): Response
    {
        // handle the request here
    }
};
```

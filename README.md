# Http Server

| `master` | `develop` |
|----------|-----------|
| [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Innmind/HttpServer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Innmind/HttpServer/?branch=master) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Innmind/HttpServer/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/HttpServer/?branch=develop) |
| [![Code Coverage](https://scrutinizer-ci.com/g/Innmind/HttpServer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Innmind/HttpServer/?branch=master) | [![Code Coverage](https://scrutinizer-ci.com/g/Innmind/HttpServer/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/HttpServer/?branch=develop) |
| [![Build Status](https://scrutinizer-ci.com/g/Innmind/HttpServer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Innmind/HttpServer/build-status/master) | [![Build Status](https://scrutinizer-ci.com/g/Innmind/HttpServer/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/HttpServer/build-status/develop) |

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

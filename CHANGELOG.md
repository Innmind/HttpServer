# Changelog

## 6.1.0 - 2026-08-16

### Changed

- Requires PHP `8.5`

## 6.0.0 - 2026-02-08

### Changed

- Requires PHP `8.4`
- Requires `innmind/operating-system:~7.0`
- `Innmind\HttpServer\Main::preload()` environment variables are now expressed with a `Innmind\Immutable\Map<string, string>`

### Fixed

- Errors thrown during the handling of a request were displayed

## 5.0.0 - 2025-07-13

### Changed

- Requires `innmind/operating-system:~6.0`
- Requires `innmind/http:~8.0`

### Fixed

- PHP `8.4` deprecation

## 4.1.0 - 2024-03-10

### Added

- Support for `innmind/operating-system:~5.0`

## 4.0.0 - 2023-11-01

### Changed

- Requires `innmind/http:~7.0`
- Requires `innmind/operating-system:~4.0`

### Removed

- Support for PHP `8.1`

## 3.2.0 - 2023-01-29

### Added

- Support for `innmind/http:~6.0`

## 3.1.0 - 2023-01-02

### Added

- `Innmind\HttpServer\Main` now accepts `Innmind\OperatingSystem\Config` as an argument to its constructor

### Changed

- Requires `innmind/operating-system:~3.4`

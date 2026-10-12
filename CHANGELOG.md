# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.1] - 2026-10-12

### Fixed

- `Orders` and `Invoices` no longer extend `CrudResource` with incompatible `create(): array` (PHP fatal on class load)
- `Invoices::get()` / `create()` support public MD5 hash parity (`public_invoice_id`)

## [1.0.0] - 2026-10-12

### Added

- Initial release: PHP HTTP client for the yourBureau REST API v3

# AGENTS.md

PHP client for the yourBureau REST API v3 (`yourbureau/api-client`).

## Contract

- Source of truth: sibling API repo `../indual-yourbureau-api/docs/openapi/openapi.yaml`
- Keep resource methods aligned with documented `/api/v3/` operations
- Auth: `X-Tenant` + `X-API-Key` only (no JWT)

## Resources

- Standard collection CRUD → extend `CrudResource`, implement `path()`, add a lazy accessor on `Client`
- Special or nested actions → methods on the parent resource (or a small dedicated class), paths 1:1 with OpenAPI
- Binary downloads → `Client::requestRaw()`; JSON+Base64 uses `request()`
- Payloads and responses are `array` — no DTOs, no codegen

## Docs and release

- Update the README resource table when adding accessors
- Record client-facing changes in `CHANGELOG.md` (feature → minor SemVer)
- Run `composer test` after changes
- Publish via annotated Git tag `vX.Y.Z` + push; Packagist versions come from tags (see CONTRIBUTING.md)

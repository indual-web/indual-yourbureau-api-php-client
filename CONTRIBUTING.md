# Contributing

## Add a standard CRUD resource

1. Create `src/Resource/YourResources.php` extending `CrudResource` with `path()` returning `/api/v3/...`
2. Add a lazy accessor on `Client` (nullable property + `??=`)
3. Add a row to the README resource table
4. Add a `CHANGELOG.md` bullet under Unreleased / next minor
5. Run `composer test`

## Add a special action

Add a method on the related resource class that calls `httpGet` / `httpPost` / `httpPatch` / `httpDelete` (or `requestRaw` for binary) with the OpenAPI path. Do not invent paths not in OpenAPI.

## Style

Follow existing `src/` conventions: `final` resource classes, strict types, `array` payloads.

## Release (Packagist)

Packagist does **not** read a version from `composer.json`. It discovers versions from **Git tags** on the connected VCS repository.

### SemVer

- Patch (`1.0.x`): bug fixes only
- Minor (`1.x.0`): new resources/methods, backward compatible
- Major (`x.0.0`): breaking API changes

Move `CHANGELOG.md` entries from `[Unreleased]` into a dated section (e.g. `## [1.2.0] - YYYY-MM-DD`) before tagging.

### Publish a new version

```bash
composer test
git add -A
git commit -m "feat: …"   # or fix:/docs: as appropriate
git tag -a v1.2.0 -m "v1.2.0"
git push origin main --tags
```

Use an annotated tag named `vMAJOR.MINOR.PATCH` (leading `v` is fine; Packagist normalizes it).

### First-time Packagist setup (once)

1. Ensure `composer.json` has a unique `name` (`yourbureau/api-client`), `description`, and `license`
2. Push the repo to GitHub (already: `indual-web/indual-yourbureau-api-php-client`)
3. On [packagist.org](https://packagist.org/packages/submit): submit the GitHub URL
4. In Packagist package settings → **GitHub Service Hook** / API token: enable auto-update so each new tag is imported without manual “Update”
5. Consumers install with `composer require yourbureau/api-client`

After the webhook is set, every `git push --tags` of a new SemVer tag creates a Packagist version automatically.

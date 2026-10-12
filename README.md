# yourBureau API PHP Client

PHP client for the [yourBureau REST API v3](https://api.yourbureau.ch/index.php/docs/api).

- Package: `yourbureau/api-client`
- PHP: `^8.2`
- Auth: `X-Tenant` + `X-API-Key` (API key)

## Install

```bash
composer require yourbureau/api-client
```

Requires the package on [Packagist](https://packagist.org/packages/yourbureau/api-client). Until then, use a VCS repository:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/indual-web/indual-yourbureau-api-php-client.git"
    }
  ],
  "require": {
    "yourbureau/api-client": "^1.1"
  }
}
```

Local path repository while developing:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../indual-yourbureau-api-php-client"
    }
  ],
  "require": {
    "yourbureau/api-client": "*"
  }
}
```

## Releases

Versions come from **Git tags** (Packagist does not use a version field in `composer.json`). See [CONTRIBUTING.md](CONTRIBUTING.md#release-packagist) for the full process:

1. Update `CHANGELOG.md`, run `composer test`, commit
2. Tag `vMAJOR.MINOR.PATCH` and `git push origin main --tags`
3. First time only: submit the GitHub URL on [packagist.org](https://packagist.org/packages/submit) and enable the GitHub update hook
## Usage

```php
use YourBureau\Api\Client;
use YourBureau\Api\ClientConfig;

$client = new Client(new ClientConfig(
    apiKey: getenv('YOURBUREAU_API_KEY'),
    tenant: getenv('YOURBUREAU_TENANT') ?: 'indual',
    baseUrl: getenv('YOURBUREAU_API_BASE') ?: 'https://api.yourbureau.ch',
));

$customers = $client->customers()->listAll();
$customer = $client->customers()->get(3001);

$links = $client->customerContacts()->listAll(['customer_id' => 3001]);

$offers = $client->offers()->list(['search' => 'CMS Update', 'limit' => 50]);
$offer = $client->offers()->get(4990);

$created = $client->offers()->create([
    'customer_id' => 3001,
    'offer' => 'CMS Update example.ch',
    'order_category_id' => 2,
    'articles' => [
        [
            'article_number' => '123',
            'quantity' => 4,
            'description' => 'Update',
        ],
    ],
]);
```

Standard CRUD resources expose `list`, `listAll`, `get`, `create`, `update` (PATCH) and `delete`. List helpers: `list($query)` (one page) and `listAll($query)` (all pages). Default page size is 100 (API max 1000). Rate limit is typically 100 requests per minute per tenant.

## Resources

### Core

| Method | Resource |
|--------|----------|
| `$client->customers()` | `/api/v3/customers` |
| `$client->contacts()` | `/api/v3/contacts` |
| `$client->customerContacts()` | `/api/v3/customer-contacts` |
| `$client->projects()` | `/api/v3/projects` |
| `$client->outgoings()` | `/api/v3/outgoings` (+ PDF) |
| `$client->distributors()` | `/api/v3/distributors` |
| `$client->articles()` | `/api/v3/articles` |
| `$client->users()` | `/api/v3/users` |
| `$client->timeReports()` | `/api/v3/time-reports` |
| `$client->timeReportExpenses()` | `/api/v3/time-report-expenses` |
| `$client->openTasks()` | `/api/v3/open-tasks` |
| `$client->supportTickets()` | `/api/v3/support-tickets` (+ workflows) |
| `$client->offers()` | `/api/v3/offers` (+ articles, convert, email, state) |
| `$client->orders()` | `/api/v3/orders` (+ articles, convert, email, state, time-report-positions) |
| `$client->invoices()` | `/api/v3/invoices` (+ articles, email, state, payment) |

### Read-only / partial

| Method | Resource |
|--------|----------|
| `$client->events()` | `/api/v3/events` |
| `$client->workPackages()` | `/api/v3/work-packages` |
| `$client->settings()` | `/api/v3/settings` |
| `$client->userAbsences()` | `/api/v3/user-absences` |
| `$client->myTimeReports()` | `/api/v3/my-time-reports` |
| `$client->myUser()` | `/api/v3/my-user` |
| `$client->comments()` | `/api/v3/comments` |
| `$client->userLocation()` | `/api/v3/user-location` |
| `$client->assistant()` | `/api/v3/assistant/...` |

### Reference data

| Method | Resource |
|--------|----------|
| `$client->salutations()` | `/api/v3/salutations` |
| `$client->countries()` | `/api/v3/countries` |
| `$client->cantons()` | `/api/v3/cantons` |
| `$client->currencies()` | `/api/v3/currencies` |
| `$client->departments()` | `/api/v3/departments` |
| `$client->places()` | `/api/v3/places` |
| `$client->encashments()` | `/api/v3/encashments` |
| `$client->languages()` | `/api/v3/languages` |
| `$client->absenceTypes()` | `/api/v3/absence-types` |
| `$client->articleCategories()` | `/api/v3/article-categories` |
| `$client->articleTaxes()` | `/api/v3/article-taxes` |
| `$client->articleUnits()` | `/api/v3/article-units` |
| `$client->bankAccounts()` | `/api/v3/bank-accounts` |
| `$client->emailTemplates()` | `/api/v3/email-templates` |
| `$client->offerStates()` | `/api/v3/offer-states` |
| `$client->orderCategories()` | `/api/v3/order-categories` |
| `$client->orderSchedulingCategories()` | `/api/v3/order-scheduling-categories` |
| `$client->orderStates()` | `/api/v3/order-states` |
| `$client->invoiceStates()` | `/api/v3/invoice-states` |
| `$client->outgoingStates()` | `/api/v3/outgoing-states` |
| `$client->outgoingTaxes()` | `/api/v3/outgoing-taxes` |
| `$client->customerStates()` | `/api/v3/customer-states` |
| `$client->projectStates()` | `/api/v3/project-states` |
| `$client->openTaskStates()` | `/api/v3/open-task-states` |
| `$client->openTaskCategories()` | `/api/v3/open-task-categories` |
| `$client->publicHolidays()` | `/api/v3/public-holidays` |
| `$client->expenses()` | `/api/v3/expenses` |

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) and [AGENTS.md](AGENTS.md). Contract source of truth: sibling API OpenAPI at `../indual-yourbureau-api/docs/openapi/openapi.yaml`.

## License

MIT

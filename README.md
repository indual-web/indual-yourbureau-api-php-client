# yourBureau API PHP Client

PHP client for the [yourBureau REST API v3](https://api.yourbureau.ch/index.php/docs/api).

- Package: `yourbureau/api-client`
- PHP: `^8.2`
- Auth: `X-Tenant` + `X-API-Key` (API key)

## Install

```bash
composer require yourbureau/api-client
```

Until the package is on Packagist, require it via VCS:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/indual-web/indual-yourbureau-api-php-client.git"
    }
  ],
  "require": {
    "yourbureau/api-client": "^1.0"
  }
}
```

Or locally with a path repository while developing:

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

## Packagist

1. Push a SemVer tag (e.g. `v1.0.0`) to GitHub
2. Submit `https://github.com/indual-web/indual-yourbureau-api-php-client` on [packagist.org](https://packagist.org)
3. Enable the GitHub webhook for automatic updates

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

$offerId = $client->offers()->create([
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

## Resources

| Method | Resource |
|--------|----------|
| `$client->customers()` | `/api/v3/customers` |
| `$client->contacts()` | `/api/v3/contacts` |
| `$client->customerContacts()` | `/api/v3/customer-contacts` |
| `$client->offers()` | `/api/v3/offers` |
| `$client->orders()` | `/api/v3/orders` |

List helpers: `list($query)` (one page) and `listAll($query)` (all pages). Default page size is 100 (API max 1000). Rate limit is typically 100 requests per minute per tenant.

## License

MIT

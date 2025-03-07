# getBRAZA PHP SDK

## Instalação

```bash
composer install
```

## Exemplo de uso
```php
require 'src/Client.php';

$client = new GetBrazaClient("app_id", "api_key", "account_number");

// Exemplo de transação PIX
$response = $client->inputTransaction([
    "url_callback" => "https://example.com/callback",
    "amount" => "100.00"
]);
print_r($response);
```

## Testes
```bash
phpunit tests/
```
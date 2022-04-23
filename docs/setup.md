# SimonDevelop\Strapi\Setup references

## __constructor(string $url, string $token = null)
```php
$setup = new Setup('https://strapi.subdomain.fr/api');
```

## getUrl(): string
### Get url strapi api defined
```php
$url = $setup->getUrl();
```

## setUrl(string $url): self
### Define url of strapi api
```php
$setup->setUrl('https://strapi.subdomain.com/api');
```

## getToken(): ?string
### Get jwt token strapi api defined
```php
$token = $setup->getToken();
```

## setToken(?string $token): self
### Define jwt token of strapi api
```php
$setup->setToken('jwt');
```
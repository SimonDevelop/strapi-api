# SimonDevelop\Strapi\SingleType references

## __constructor(SimonDevelop\Strapi\Setup $setup)
```php
$single = new SingleType($setup);
```

## getSetup(): SimonDevelop\Strapi\Setup
### Get Setup object
```php
$setup = $single->getSetup();
```

## setSetup(SimonDevelop\Strapi\Setup $setup): self
### Define Setup object
```php
$single->setSetup($setup);
```

## get(string $single): array|string
### SingleType data (response strapi) if the request is passed, else information in string
```php
$response = $single->get('homepage');
```

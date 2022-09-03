# SimonDevelop\Strapi\CollectionType references

## __constructor(SimonDevelop\Strapi\Setup $setup)
```php
$collection = new CollectionType($setup);
```

## getSetup(): SimonDevelop\Strapi\Setup
### Get Setup object
```php
$setup = $collection->getSetup();
```

## setSetup(SimonDevelop\Strapi\Setup $setup): self
### Define Setup object
```php
$collection->setSetup($setup);
```

## get(string $collection): array|string
### CollectionType data (response strapi) if the request is passed, else information in string
```php
$response = $collection->get('users');
```

## getById(string $collection, int $id): array|string
### CollectionType data item by id (response strapi) if the request is passed, else information in string
```php
$response = $collection->get('users', 1);
```

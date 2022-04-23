# SimonDevelop\Strapi\Auth references

## __constructor(SimonDevelop\Strapi\Setup $setup)
```php
$auth = new Auth($setup);
```

## getSetup(): SimonDevelop\Strapi\Setup
### Get Setup object
```php
$setup = $auth->getSetup();
```

## setSetup(SimonDevelop\Strapi\Setup $setup): self
### Define Setup object
```php
$auth->setSetup($setup);
```

## authentication(string $identifier, string $password): array|string
### User data with JWT token (response strapi) if the request is passed, else information in string
```php
$response = $auth->authentication($identifier, $password);
```

## register(string $username, string $email, string $password): array|string
### User data (response strapi)
```php
$response = $auth->register($username, $email, $password);
```

## forgotPassword(string $email): bool|string
### Returns true if the request is passed, else information in string
```php
$response = $auth->forgotPassword($email);
```

## resetPassword(string $code, string $newPassword, string $newPasswordConfirm): array|string
### User data with JWT token (response strapi) if the request is passed, else information in string
```php
$response = $auth->resetPassword($code, $newPassword, $newPasswordConfirm);
```

## sendEmailConfirmation(string $email): bool|string
### Returns true if the request is passed, else information in string
```php
$response = $auth->sendEmailConfirmation($email);
```
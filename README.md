# Very short description of the package

[![Build Status](https://img.shields.io/travis/MHasnainJafri/cpanel/master.svg)](https://travis-ci.org/MHasnainJafri/cpanel)
[![Code Coverage](https://img.shields.io/codecov/c/github/MHasnainJafri/cpanel.svg)](https://codecov.io/gh/MHasnainJafri/cpanel)
[![License](https://img.shields.io/github/license/MHasnainJafri/cpanel.svg)](https://github.com/MHasnainJafri/cpanel/blob/master/LICENSE)
[![Latest Release](https://img.shields.io/github/release/MHasnainJafri/cpanel.svg)](https://github.com/MHasnainJafri/cpanel/releases)
[![Open Issues](https://img.shields.io/github/issues/MHasnainJafri/cpanel.svg)](https://github.com/MHasnainJafri/cpanel/issues)
[![Stars](https://img.shields.io/github/stars/MHasnainJafri/cpanel.svg)](https://github.com/MHasnainJafri/cpanel/stargazers)
[![Forks](https://img.shields.io/github/forks/MHasnainJafri/cpanel.svg)](https://github.com/MHasnainJafri/cpanel/network/members)


# Laravel CPanel Library

This Laravel library provides functions to interact with cPanel and perform various tasks related to managing emails, databases, database users, disk quota, and subdomains.

## Installation

To use this library in your Laravel project, follow these steps:

1. Install the package via Composer:

```bash

composer require your-package-name

```

2. Add the service provider to your `config/app.php` file:

```php

'providers' => [

    // ...

    Your\Package\ServiceProvider::class,

],

```

3. Publish the configuration file:

```bash

php artisan vendor:publish --provider="Your\Package\ServiceProvider"

```

4. Configure the necessary settings in the published configuration file.

## Usage

To get started, create an instance of the Cpanel class:

```php

$cpanel = new Cpanel();

```

### Call UAPI

```php

$result = $cpanel->callUAPI($Module, $function, $parameters_array = array());

```

This function allows you to call the cPanel UAPI with the specified module, function, and parameters.

### Delete Database User

```php

$result = $cpanel->deleteDatabaseUser('dbusername');

```

This function deletes the specified database user.

### Delete Database

```php

$result = $cpanel->deleteDatabase('databasename');

```

This function deletes the specified database.

### Set All Privileges On Database

```php

$result = $cpanel->setAllPrivilegesOnDatabase('dbusername', 'dbname');

```

This function grants all privileges on the specified database to the specified user.

### Create Database User

```php

$result = $cpanel->createDatabaseUser('dbuser', 'password');

```

This function creates a new database user with the specified username and password.

### List Databases

```php

$result = $cpanel->listDatabases();

```

This function returns a list of all databases.

### Create Database

```php

$result = $cpanel->createDatabase('DBname');

```

This function creates a new database with the specified name.

### Edit Mailbox Quota

```php

$result = $cpanel->editMailboxQuota($email, $domain, $quota);

```

This function allows you to edit the quota of a mailbox associated with the specified email and domain.

### Delete POP Email Account

```php

$result = $cpanel->deletePopEmailAccount('mail');

```

This function deletes the specified POP email account.

### Dispatch Client Settings

```php

$result = $cpanel->dispatchClientSettings('mail', 'account');

```

This function dispatches the client settings for the specified account.

### Get POP Email Count

```php

$result = $cpanel->getPopEmailCount();

```

This function returns the count of POP email accounts.

### Create POP Email Account

```php

$result = $cpanel->createPopEmailAccount('mailorg', 'password');

```

This function creates a new POP email account with the specified email and password.

### Get cPanel Stats Bar Stats

```php

$result = $cpanel->getCpanelStatsBarStats('bandwidthusage|diskusage');

```

This function returns the statistics for the cPanel stats bar, such as bandwidth usage and disk usage.

### Get cPanel Disk Quota Info

```php

$result = $cpanel->getCpanelDiskQuotaInfo();

```

This function returns the disk quota information for cPanel.

### Create Subdomain

```php

$result = $cpanel->createSubDomain('subdomain', 'domain', 'path');

```

This function creates a new subdomain with the specified name, domain, and document root.

Feel free to use these functions to interact with cPanel and perform various management tasks.



## Usage

```php
// Usage description here
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mhasnainjafri0099@gmail.com instead of using the issue tracker.

## Credits

-   [Muhammad Hasnain](https://github.com/hasnain)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

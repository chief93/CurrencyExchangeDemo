# Currency Exchange example projects

This is a repository for implementations of a currency exchange application. Examples are made within `Quark` and `Symfony`

The scope of this repository is to demonstrate the difference between two different frameworks, saving the notes for myself for using of Symfony (many unobvious configuration things need to be placed somewhere) and demonstrating an up-to-dated example of `Quark`-based application, adjusted to the last stable `Quark` version.

Both projects can work with same database simultaneously. You can use the `data.db` as data source.

### Quark-based

#### Requirements
 - [Quark](https://github.com/Qybercom/quark)
 - SQLite (3+)
 - PHP (5.4+)

#### Installation
 1. Clone (or download `.zip` archive) of Quark
 2. Rename `loader-example.php` in `loader.php`
 3. Put the path to `Quark.php` in `loader.php`
 4. Create a `./runtime` directory in the project root
 5. Rename `application-example.ini` in `application.ini` and move it in `./runtime` directory
 6. Adjust the settings in the `./runtime/application.ini` to your environment:
    - Set an appropriate WebHost (FQDN) for project *(optional)*
    - Set database connection URI (path to SQLite file)
 7. Enjoy!

#### Running
`$ php ./index.php -q host/fpm`

#### Currency rates updating
`$ php ./index.php /symbol/update-rates`

### Laravel-based

#### Requirements
 - [Symfony](https://symfony.com/) (4.2+)
 - SQLite (3)
 - PHP (7.1+)
 - Composer

#### Installation
 1. `composer install`
 2. Adjust application settings in `./.env-local` file
 > *2.1. Optional: If you haven't used the `data.db`, you can use the provided migrations for restoring database structure*
 3. Enjoy!

#### Running
`$ php bin/console server:start`

#### Currency rates updating
`$ php bin/console symbol:update-rates`
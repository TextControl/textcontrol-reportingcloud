![Logo](./resource/rc_logo_512.png)

# CONTRIBUTING

## Configure Development Environment

### Check out Project and Run Composer

```bash
mkdir -p /var/www/textcontrol/textcontrol-reportingcloud

cd /var/www/textcontrol/textcontrol-reportingcloud

git clone git@github.com:TextControl/textcontrol-reportingcloud-php.git .

composer update

composer dump-autoload --optimize
```

### Set up GitHub

Click "Keep my email address private" at https://github.com/settings/emails and use the shown email.

```bash
git config user.name  "John Doe"
git config user.email "johndoe@users.noreply.github.com"
```

## Tag and Release Version

```bash
git tag release-4.0.x && git push origin --tags
```

## API Documentation (phpdoc)

All the source code in this component library is documented using [phpDocumentor](https://www.phpdoc.org/).

You can read the [API documentation](https://textcontrol.github.io/textcontrol-reportingcloud-php/docs-api/) online.

The API documentation is built and published as follows:

```bash
bin/build-gh-pages.sh
```

## Unit Tests With Code Coverage (phpunit)

100% unit test coverage is supplied by phpunit.

You can review the [code coverage report](https://textcontrol.github.io/textcontrol-reportingcloud-php/test-coverage/) online, or build it yourself, using the following shell command:

The code coverage report is built and published as follows:

```bash
bin/build-gh-pages.sh
```

## Coding Standards

This component library follows [PSR-2](http://www.php-fig.org/psr/psr-2/) coding standards, and additionally:

* Uses lowercase underscore-separated keys names for associative arrays.
* Uses camelCase for namespaces, class, method and property names.

When contributing, please respect this standard with its two above mentioned additions.

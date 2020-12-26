PHP Helm Wrapper
================

![CI](https://github.com/renoki-co/php-helm/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/renoki-co/php-helm/branch/master/graph/badge.svg)](https://codecov.io/gh/renoki-co/php-helm/branch/master)
[![StyleCI](https://github.styleci.io/repos/323445250/shield?branch=master)](https://github.styleci.io/repos/323445250)
[![Latest Stable Version](https://poser.pugx.org/renoki-co/php-helm/v/stable)](https://packagist.org/packages/renoki-co/php-helm)
[![Total Downloads](https://poser.pugx.org/renoki-co/php-helm/downloads)](https://packagist.org/packages/renoki-co/php-helm)
[![Monthly Downloads](https://poser.pugx.org/renoki-co/php-helm/d/monthly)](https://packagist.org/packages/renoki-co/php-helm)
[![License](https://poser.pugx.org/renoki-co/php-helm/license)](https://packagist.org/packages/renoki-co/php-helm)

![Min. K8s Version](https://img.shields.io/badge/Min.%20K8s%20Version-v1.17.16%2B-%23326ce5)
![Max. K8s Version](https://img.shields.io/badge/Max.%20K8s%20Version-v1.19.6-%23326ce5)

PHP Helm is a process wrapper for Kubernetes' Helm v3. You can run Helm v3 commands directly from PHP with a simple syntax.

The package is running on top of [symfony/process](https://symfony.com/doc/current/components/process.html), so the API is easily accessible.

## 🤝 Supporting

Renoki Co. on GitHub aims on bringing a lot of open source projects and helpful projects to the world. Developing and maintaining projects everyday is a harsh work and tho, we love it.

If you are using your application in your day-to-day job, on presentation demos, hobby projects or even school projects, spread some kind words about our work or sponsor our work. Kind words will touch our chakras and vibe, while the sponsorships will keep the open source projects alive.

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/R6R42U8CL)

## 🚀 Installation

You can install the package via composer:

```bash
composer require renoki-co/php-helm
```

For Laravel, you may Publish the config:

```bash
$ php artisan vendor:publish --provider="RenokiCo\PhpHelm\PhpHelmServiceProvider" --tag="config"
```

## 🙌 Usage

```php
use RenokiCo\PhpHelm\Helm;

$helm = Helm::call('repo', [
    'add',
    'stable',
    'https://charts.helm.sh/stable',
])->run();

// The process is based on symfony/process
echo $helm->getOutput();
```

## Flags & Environment Variables

You might want to pass flags to the commands:

```php
use RenokiCo\PhpHelm\Helm;

$helm = Helm::call('repo', [
    'add',
    'stable',
    'https://charts.helm.sh/stable',
], ['--no-update' => true]);
```

A third parameter is used for envs:

```php
use RenokiCo\PhpHelm\Helm;

$helm = Helm::call('repo', [
    'add',
    'stable',
    'https://charts.helm.sh/stable',
], ['--no-update' => true], ['SOME_ENV' => '1234']);
```

## Specifying Binary Path

You can call it once to set the path to the binary to the `helm` cli:

```php
use RenokiCo\PhpHelm\Helm;

Helm::setHelmPath('/usr/bin/my-path/helm');
```

For Laravel, you might simply publish the config and set the `HELM_PATH` env variable:

```
HELM_PATH=/usr/bin/my-path/helm
```

## 🐛 Testing

``` bash
vendor/bin/phpunit
```

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🔒  Security

If you discover any security related issues, please email alex@renoki.org instead of using the issue tracker.

## 🎉 Credits

- [Alex Renoki](https://github.com/rennokki)
- [All Contributors](../../contributors)

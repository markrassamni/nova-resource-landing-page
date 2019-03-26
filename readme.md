# Laravel Nova: Resource Landing Page
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/markrassamni/nova-resource-landing-page)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/markrassamni/nova-resource-landing-page.svg?style=flat-square)](https://packagist.org/packages/markrassamni/nova-resource-landing-page)
[![Total Downloads](https://img.shields.io/packagist/dt/markrassamni/nova-resource-landing-page.svg?style=flat-square)](https://packagist.org/packages/markrassamni/nova-resource-landing-page)

Adds the ability to create a navigation link directly to the detail, create, or edit page of a resource.

![](https://github.com/markrassamni/nova-resource-landing-page/raw/master/demo.gif)

## Prerequisites
 - [Laravel](https://laravel.com/)
 - [Laravel Nova](https://nova.laravel.com/)

## Installation

```
$ composer require markrassamni/nova-resource-landing-pag
```

Modify `app/Nova/Resource.php` to implement `ResourceLandingPageInterface` and the `SupportChangeResourceLandingPage` trait:

```php
<?php

namespace App\Nova;

use MarkRassamni\NovaResourceLandingPage\Contracts\SupportChangeResourceLandingPage;
use MarkRassamni\NovaResourceLandingPage\Traits\ResourceLandingPageInterface;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource implements ResourceLandingPageInterface
{
    use SupportChangeResourceLandingPage;

    ...
}
```

Publish assets:
```
$ php artisan vendor:publish --provider="MarkRassamni\NovaResourceLandingPage\Providers\NovaResourceLandingPageServiceProvider"
```


## Update

When updating it is important to republish the assets, like so:

```
$ php artisan vendor:publish --force --provider="MarkRassamni\NovaResourceLandingPage\Providers\NovaResourceLandingPageServiceProvider"
```


## Uninstallation

Remove from composer

```
$ composer remove markrassamni/nova-resource-landing-page
```

Remove `SupportChangeResourceLandingPage` trait from your Nova Resources

```
use SupportChangeResourceLandingPage;
```

Remove the customized navigation template

```
rm resources/views/vendor/nova/resources/navigation.blade.php
```

## Usage

Place the following method on models that should land on the detail page.

```php
class MyResource extends Resource
{
    public static function detail(): bool
    {
        return true;
    }
}
```

Place the following method on models that should land on the create page.

```php
class MyResource extends Resource
{
    public static function create(): bool
    {
        return true;
    }
}
```

Place the following method on models that should land on the edit page.

```php
class MyResource extends Resource
{
    public static function edit(): bool
    {
        return true;
    }
}
```

Optionally override the resource identifier when opening the detail or edit page.

```php
class MyResource extends Resource
{
    /**
     * @return string|int
     */
    public static function recordId()
    {
        return 1;
    }
}
```

## How it works

Laravel Nova has the ability to override the Blade template used to render the navigation sidebar.
The template is copied from Nova version v1.2.0 and altered with a few lines to support linking a resource directly to the detail view.
When publishing vendor assets with the tag `nova-views` the template will be placed in the project `resources/views/vendor/nova/resources` folder.

<details>
<summary>View changes</summary>

```php
@if ($resource::detail())
    <router-link :to="{
        name: 'detail',
        params: {
            resourceName: '{{ $resource::uriKey() }}',
            resourceId: {{ $resource::recordId() }}
        }
    }" class="text-white text-justify no-underline dim">
        {{ $resource::label() }}
    </router-link>
@elseif ($resource::create())
    <router-link :to="{
        name: 'create',
        params: {
            resourceName: '{{ $resource::uriKey() }}',
        }
    }" class="text-white text-justify no-underline dim">
        {{ $resource::label() }}
    </router-link>
@elseif ($resource::edit())
    <router-link :to="{
        name: 'edit',
        params: {
            resourceName: '{{ $resource::uriKey() }}',
            resourceId: {{ $resource::recordId() }}
        }
    }" class="text-white text-justify no-underline dim">
        {{ $resource::label() }}
    </router-link>
@else
    <router-link :to="{
        name: 'index',
        params: {
            resourceName: '{{ $resource::uriKey() }}'
        }
    }" class="text-white text-justify no-underline dim">
        {{ $resource::label() }}
    </router-link>
@endif
```
</details>

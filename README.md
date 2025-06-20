
# Laravel Attribute Model Casting

[![Laravel 11+](https://img.shields.io/badge/Laravel-11%2B-blue)](https://laravel.com)
[![Packagist Downloads](https://img.shields.io/packagist/dt/kontoulis/laravel-attribute-model-casting)](https://packagist.org/packages/kontoulis/laravel-attribute-model-casting)
[![License](https://img.shields.io/github/license/kontoulis/laravel-attribute-model-casting)](https://github.com/kontoulis/laravel-attribute-model-casting/LICENSE)

## Table of Contents

- [Introduction](#introduction)
- [Motivation](#motivation)
- [Installation](#installation)
- [Usage](#usage)
  - [Defining Casts with Attributes](#defining-casts-with-attributes)
  - [Benefits](#benefits)
- [Contributing](#contributing)
- [License](#license)

## Introduction

This package introduces a `Cast` attribute to enhance type casting for Eloquent model attributes. By leveraging PHP 8 attributes, this package allows you to define casts in a more modern, reusable, and maintainable way, especially when working with traits.

**Note**: This approach can be used together with the existing Eloquent casting system. The `Cast` attribute will be applied in addition to any other casts defined in the model.

## Motivation

Defining casts in Eloquent models can become repetitive, especially when the same casts are applied across multiple models. This package provides a clean and modern solution by allowing you to define casts using attributes, making it easier to reuse and maintain your code.

## Installation

You can install the package via Composer:

```bash
composer require kontoulis/laravel-attribute-model-casting
```

### Prerequisites

- PHP 8.0 or higher
- Laravel 11 or higher

## Usage

### Defining Casts with Attributes

You can use the `Cast` attribute to define type casting for model properties.  
To resolve the actual casts, the model must use the included `AttributeCasting` trait.

Here's an example:

```php
use Kontoulis\LaravelAttributeModelCasting\AttributeCasting;
use Kontoulis\LaravelAttributeModelCasting\Cast;

#[Cast('price', Price::class)]
trait HasPrice {
    public function priceEquals(Price $other): bool
    {
        return $this->amount === $other->amount && $this->currency === $other->currency;
    }
}

#[Cast('normalModelAttribute', 'int')]
class EloquentModelWithAttributeCasts extends Model
{
    use AttributeCasting;
    use HasPrice;
}
```

In this example:
- The `HasPrice` trait defines a `Cast` attribute for the `price` property, allowing it to be reused across multiple models.
- The `EloquentModelWithAttributeCasts` class uses the `Cast` attribute to define a cast for the `normalModelAttribute` property.

### Benefits

- **Reusability**: Define casts once in a trait and reuse them across multiple models.
- **Modern Syntax**: Leverage PHP 8 attributes for a cleaner and more expressive syntax.
- **Reduced Redundancy**: No need to manually define the same casts in every model.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## License

This package is open-sourced software licensed under the [MIT license](https://github.com/kontoulis/laravel-attribute-model-casting/LICENSE).

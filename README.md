# Filesystem

[![BracketSpace Micropackage](https://img.shields.io/badge/BracketSpace-Micropackage-brightgreen)](https://bracketspace.com)
[![Latest Stable Version](https://poser.pugx.org/micropackage/filesystem/v/stable)](https://packagist.org/packages/micropackage/filesystem)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/micropackage/filesystem.svg)](https://packagist.org/packages/micropackage/filesystem)
[![Total Downloads](https://poser.pugx.org/micropackage/filesystem/downloads)](https://packagist.org/packages/micropackage/filesystem)
[![License](https://poser.pugx.org/micropackage/filesystem/license)](https://packagist.org/packages/micropackage/filesystem)

<p align="center">
    <img src="https://bracketspace.com/extras/micropackage/micropackage-small.png" alt="Micropackage logo"/>
</p>

## 🧬 About Filesystem

This micropackage is a wrapper for WordPress filesystem intended to be used within the `wp-content` directory.

Supports:
- plugins
- must-use plugins
- themes
- custom upload directories
- custom wp-content directories

This package will prefix all the relative paths to full paths giving a convinient way to manipulate files.

## 💾 Installation

``` bash
composer require micropackage/filesystem
```

## 🕹 Usage

Initializing the Filesystem class from the main plugin/theme file. It just needs a base directory.

```php
use Micropackage\Filesystem\Filesystem;

$filesystem = new Filesystem( __DIR__ );
```

Using the micropackage to obtain full paths (plugin example).

```php
echo $filesystem->path();
// /var/www/html/wp-content/plugins/my-plugin/

echo $filesystem->path( 'src/templates/full-width.php' );
// /var/www/html/wp-content/plugins/my-plugin/src/templates/full-width.php
```

Using the micropackage to obtain full URL (plugin example).

```php
echo $filesystem->url();
// https://my.plugin/wp-content/plugins/my-plugin/

echo $filesystem->url( 'assets/images/logo.svg' );
// https://my.plugin/wp-content/plugins/my-plugin/assets/images/logo.svg
```

Convert image file to base64 URL.

```php
echo '<img src="' . $filesystem->image_to_base64( 'assets/images/logo.svg' ) . '">';
// <img src="data:image/svg+xml;base64,m8q76v7wy4guiev...">
```

On top of that, you can use any method provided by WP_Filesystem class, which includes:
- `get_contents()`
- `exists()`
- `is_file()`, `is_dir()`
- `mkdir()`
- `delete()`
- ...

[See all available methods](https://developer.wordpress.org/reference/classes/wp_filesystem_base/#methods)

## 📦 About the Micropackage project

Micropackages - as the name suggests - are micro packages with a tiny bit of reusable code, helpful particularly in WordPress development.

The aim is to have multiple packages which can be put together to create something bigger by defining only the structure.

Micropackages are maintained by [BracketSpace](https://bracketspace.com).

## 📖 Changelog

[See the changelog file](./CHANGELOG.md).

## 📃 License

GNU General Public License (GPL) v3.0. See the [LICENSE](./LICENSE) file for more information.

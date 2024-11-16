# [PHP Larvael Android Apk Parser](http://abaydullah.com/)

This package can extract application package files in APK format used by devices running on Android OS. It can open an
APK file and extract the contained manifest file to parse it and retrieve the meta-information it contains like the
application name, description, device feature access permission it requires, etc.. The class can also extract the whole
files contained in the APK file to a given directory.

### Requirements

PHP 8.1+  

Installation
------------

Add `abaydullah/php-laravel-android-apk-parser` as a require dependency in your `composer.json` file:

```sh
$ composer require abaydullah/php-laravel-android-apk-parser
```
Usage
-----

First create a `Scraper` instance.

```php
use Abaydullah\ApkParser\Parser;

include 'autoload.php';
$apk = new Parser('APK URL');

$manifest = $apk->getManifest();
$permissions = $manifest->getPermissions();

echo '<pre>';
echo "Package Name      : " . $manifest->getPackageName() . "" . PHP_EOL;
echo "Version           : " . $manifest->getVersionName() . " (" . $manifest->getVersionCode() . ")" . PHP_EOL;
echo "Min Sdk Level     : " . $manifest->getMinSdkLevel() . "" . PHP_EOL;
echo "Min Sdk Platform  : " . $manifest->getMinSdk()->platform . "" . PHP_EOL;
echo "Target Sdk Level     : " . $manifest->getTargetSdkLevel() . "" . PHP_EOL;
echo "Target Sdk Platform  : " . $manifest->getTargetSdk()->platform . "" . PHP_EOL;
echo PHP_EOL;
echo "------------- Permssions List -------------" . PHP_EOL;

// find max length to print more pretty.
$perm_keys = array_keys($permissions);
$perm_key_lengths = array_map(
    function ($perm) {
        return strlen($perm);
    },
    $perm_keys
);
$max_length = max($perm_key_lengths);

foreach ($permissions as $perm => $detail) {
    echo str_pad($perm, $max_length + 4, ' ') . "=> " . $detail['description'] . " " . PHP_EOL;
    echo str_pad(
        '',
        $max_length - 5,
        ' '
    ) . ' cost    =>  ' . ($detail['flags']['cost'] ? 'true' : 'false') . " " . PHP_EOL;
    echo str_pad(
        '',
        $max_length - 5,
        ' '
    ) . ' warning =>  ' . ($detail['flags']['warning'] ? 'true' : 'false') . " " . PHP_EOL;
    echo str_pad(
        '',
        $max_length - 5,
        ' '
    ) . ' danger  =>  ' . ($detail['flags']['danger'] ? 'true' : 'false') . " " . PHP_EOL;
}


echo PHP_EOL;
echo "------------- Activities  -------------" . PHP_EOL;
foreach ($apk->getManifest()->getApplication()->activities as $activity) {
    echo $activity->name . ($activity->isLauncher ? ' (Launcher)' : null) . PHP_EOL;
}

```
## Testing

Tests are powered by PHPUnit. You have several options.

- Run `phpunit` if PHPUnit is installed globally.
- Install dependencies (requires [Composer](https://getcomposer.org/download)). Run `php composer.phar --dev install`
  or `composer --dev install`. Then `bin/vendor/phpunit` to run version installed by Composer. This ensures that you are
  running a version compatible with the test suite.

## Contributing

Fork the repo, make your changes, add your name to developers, and create a pull request with a comment that describe
your changes. That's all!
[Thanks to all contributers](https://github.com/tufanbarisyildirim/php-apk-parser/graphs/contributors)

## Thanks

Thanks JetBrains for the free open source license

<a href="https://www.jetbrains.com/?from=tufanbarisyildirim" target="_blank">
	<img src="https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.png" width = "260" align=center  alt="Jetbrains"/>
</a>

### License

Apk Parser is [MIT licensed](./LICENSE.md).

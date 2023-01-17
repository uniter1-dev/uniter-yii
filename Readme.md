Yii2 commands for remote requests to Uniter1 test generation service

This package provides 2 commands: first for registration, second for test generation request.

## Short instruction
composer require uniter1/uniter-yii

// edit config/console.php

'controllerMap' => [
...
    'uniter1' => [
        'class' => 'app\commands\uniter\src\Uniter1Yii',
        'config' => [
            'accessToken'         => your requested token,
            'basePath'            => dirname(__DIR__),
            'projectDirectory'    => dirname(__DIR__),
    ],
]

// get registered token
php yii uniter1/register {email} {password}

read email and put token to config/console.php

// generate test for your php class file
php yii uniter1/generate path/to/file

result should be written to yours unitTestsDirectory (see in config/console.php)


## Installation

You can install the package via composer:

```bash
composer require uniter1/uniter-yii
```
## Testing

## Usage

### User registration:
```php
php yii uniter1/register {email} {password}
```
User will be registered, and access token will be sent to your email. You need to put that token to yours config/console.php file as 'accessToken'. After that you can send test generation queries.

### Package settings:

Other options (in uniter/config.php) you may remain as defaults. You can overwrite them in config/console.php. Check that unit tests directory (defaults storage/tests/Unit) exists and is writable.


```bash
'baseUrl' => https://uniter1.tech
```
This is web address for our service. Use https://uniter1.tech

```bash
'obfuscate' => true
```
Obfuscation option. Set it to false if you need no obfuscation for you code.
```bash
'unitTestBaseClass' => PHPUnit\Framework\TestCase
```
Base framework for yours test class.
```bash
'unitTestsDirectory' => tests/Unit
```
Base directory to save generated test classes. Check that directory exists and is writable.

### Test generation
```bash
php yii uniter1/generate {filePath}
```
Your class you want to test will be read from {filePath}, obfuscated if you did not turn obfuscation off, sent to our service. There will be created some phpunit test file to test different variants of yours class methods. The result will be deobfuscated and saved to 'unitTestsDirectory'- to some nested folder according to class namespace.

Open it, read it and use to test yours class.

Generated class, possibly, will not be completed test - read comments before each generated test method.
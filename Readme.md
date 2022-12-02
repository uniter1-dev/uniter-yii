## Short instruction
composer require php-uniter/php-uniter-yii

// edit config/console.php

'controllerMap' => [
...
    'php-uniter' => [
        'class' => 'vendor/php-uniter/php-uniter-yii',
        'config' => [
            'accessToken'         => 'yours token after registration',
            'baseNamespace'       => 'Tests\Unit',
            'basePath'            => dirname(__DIR__),
            'baseUrl'             => 'http://uniter1.tech',
            'helperClass'         => 'PhpUniter\PhpUniterRequester\PhpUnitTestHelper',
            'generationPath'      => '/api/v1/generator/generate',
            'obfuscate'           => true,
            'preprocess'          => true,
            'projectDirectory'    => dirname(__DIR__),
            'registrationPath'    => '/api/v1/registration/access-token',
            'unitTestBaseClass'   => 'PHPUnit\Framework\TestCase',
            'unitTestsDirectory'  => '/tests/Unit'
        ],
    ],
]

// get registered token
php yii php-uniter/register {email} {password}

read email and put token to config/console.php

// generate test for your php class file
php yii php-uniter/generate path/to/file

result should be written to yours unitTestsDirectory (see in config/console.php)

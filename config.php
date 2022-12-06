<?php

return [
    'baseNamespace'       => 'uniter',
    'baseUrl'             => 'http://uniter1.loc',
    'helperClass'         => 'PhpUniter\PhpUniterRequester\PhpUnitTestHelper',
    'generationPath'      => '/api/v1/generator/generate',
    'obfuscate'           => true,
    'registrationPath'    => '/api/v1/registration/access-token',
    'unitTestBaseClass'   => 'PHPUnit\Framework\TestCase',
    'unitTestsDirectory'  => '/tests'
];
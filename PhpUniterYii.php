<?php

namespace app\commands\uniter;

use PhpUniter\PhpUniterRequester\Application\Obfuscator\Preprocessor;
use PhpUniter\PhpUniterRequester\Requester;
use PhpUniter\PhpUniterRequester\RequesterFactory;
use yii\console\Controller;

class PhpUniterYii extends Controller
{

    public array $config;

    public function actionRegister($email, $password)
    {
        $registerService = RequesterFactory::registerServiceFactory($this->config);
        $phpUnitService = RequesterFactory::generateServiceFactory($this->config);
        $preprocessor = new Preprocessor($this->config['preprocess']);
        $requester = new Requester($registerService, $phpUnitService, $preprocessor, $this->config['projectDirectory']);
        $code = $requester->register($email, $password);

        if (0 === $code) {
            $this->stdout('User registered. Access token in your email. Put it in .env file - PHP_UNITER_ACCESS_TOKEN'."\n");
        }

        $report = $requester->getReport();
        foreach ($report->getErrors() as $message) {
            $this->stderr($message);
        }

        return $code;
    }

    public function actionGenerate($filePath)
    {
        $registerService = RequesterFactory::registerServiceFactory($this->config);
        $phpUnitService = RequesterFactory::generateServiceFactory($this->config);
        $preprocessor = new Preprocessor($this->config['preprocess']);
        $requester = new Requester($registerService, $phpUnitService, $preprocessor, $this->config['projectDirectory']);
        $code =  $requester->generate($filePath);

        $report = $requester->getReport();
        foreach ($report->getErrors() as $message) {
            $this->stderr($message);
        }

        foreach ($report->getInfos() as $message) {
            $this->stdout($message);
        }

        return $code;
    }
}
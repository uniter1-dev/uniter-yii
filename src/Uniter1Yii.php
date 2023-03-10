<?php

namespace Uniter1\UniterYii;

use Uniter1\UniterRequester\Requester;
use Uniter1\UniterRequester\RequesterFactory;
use yii\console\Controller;

class Uniter1Yii extends Controller
{

    public array $config;

    public function actionRegister($email, $password)
    {
        $this->mergeConfig();
        $registerService = RequesterFactory::registerServiceFactory($this->config);
        $phpUnitService = RequesterFactory::generateServiceFactory($this->config);
        $requester = new Requester($registerService, $phpUnitService, $this->config['projectDirectory']);
        $code = $requester->register($email, $password);

        if (0 === $code) {
            $this->stdout('User registered. Access token in your email. Put it in .env file - UNITER1_ACCESS_TOKEN'."\n");
        }

        $report = $requester->getReport();
        foreach ($report->getErrors() as $message) {
            $this->stderr($message);
        }

        return $code;
    }

    public function actionGenerate($filePath, $overwriteOneMethod = '')
    {
        $this->mergeConfig();
        $registerService = RequesterFactory::registerServiceFactory($this->config);
        $phpUnitService = RequesterFactory::generateServiceFactory($this->config);

        $requester = new Requester($registerService, $phpUnitService, $this->config['projectDirectory']);
        $code =  $requester->generate($filePath, $overwriteOneMethod);

        $report = $requester->getReport();
        foreach ($report->getErrors() as $message) {
            $this->stderr($message);
        }

        foreach ($report->getInfos() as $message) {
            $this->stdout($message);
        }

        return $code;
    }

    public function mergeConfig()
    {
        $defaultConfig = require __DIR__.'/../config.php';
        foreach ($defaultConfig as $id => $value) {
            if (empty($this->config[$id])) {
                $this->config[$id] = $defaultConfig[$id];
            }
        }
    }

}
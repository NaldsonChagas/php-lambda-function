<?php

namespace ReverseGeocode\SaveFile\Configs;

use \Symfony\Component\Dotenv\Dotenv;

class InitialConfigs
{
    public function config(): void
    {
        $this->configDotEnv();
    }

    private function configDotEnv(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
    }
}

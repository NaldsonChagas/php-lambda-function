<?php

require 'vendor/autoload.php';

use \ReverseGeocode\SaveFile\Utils\Response;
use \ReverseGeocode\SaveFile\Services\FileUploaderService;
use \ReverseGeocode\SaveFile\Clients\ProjectS3Client;
use \ReverseGeocode\SaveFile\Configs\InitialConfigs;

(new InitialConfigs())->config();

function index($input): string
{
    $uploaderClient = new ProjectS3Client();
    (new FileUploaderService($uploaderClient))->uploadAndNotify($input['file']);

    return Response::apiResponse('hello world');
}

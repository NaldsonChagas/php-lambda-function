<?php

require 'vendor/autoload.php';

use \Naldson\LambdaSaveFile\Utils\Response;
use \Naldson\LambdaSaveFile\Services\FileUploaderService;
use \Naldson\LambdaSaveFile\Clients\ProjectS3Client;
use \Naldson\LambdaSaveFile\Configs\InitialConfigs;

(new InitialConfigs())->config();

function index($input): string
{
    $uploaderClient = new ProjectS3Client();
    (new FileUploaderService($uploaderClient))->uploadAndNotify($input['file']);

    return Response::apiResponse('hello world');
}

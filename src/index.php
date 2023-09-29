<?php

require 'vendor/autoload.php';

use \ReverseGeocode\SaveFile\Utils\Response;
use \ReverseGeocode\SaveFile\Services\FileUploaderService;
use \ReverseGeocode\SaveFile\Services\NotifyService;
use \ReverseGeocode\SaveFile\Clients\ProjectS3Client;
use \ReverseGeocode\SaveFile\Clients\ProjectSqsClient;
use \ReverseGeocode\SaveFile\Configs\InitialConfigs;

(new InitialConfigs())->config();

function index($input): string
{
    $uploaderClient = new ProjectS3Client();
    $notifierClient = new ProjectSqsClient();

    try {
        $fileKey = (new FileUploaderService($uploaderClient))
            ->upload($input['file']);

        (new NotifyService($notifierClient))
            ->notify($fileKey, $input['email']);

        return Response::apiResponse('File queued');
    } catch (\Exception $exception) {
        echo $exception->getMessage();
        error_log($exception->getMessage());
        return Response::apiResponse('Error on queue file', 500);
    }
}

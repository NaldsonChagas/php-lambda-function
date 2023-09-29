<?php

namespace ReverseGeocode\SaveFile\Clients;

use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use ReverseGeocode\SaveFile\Domains\Dtos\QueueParamsDto;

readonly class ProjectSqsClient implements NotifierClient
{
    private SqsClient $sqsClient;

    public function __construct()
    {
        $this->sqsClient = new SqsClient([
            'region' => $_ENV['SQS_CLIENT_REGION'],
            'version' => $_ENV['SQS_CLIENT_VERSION'],
            'credentials' => [
                'key' => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ]
        ]);
    }

    public function notify(QueueParamsDto $queueParamsDto): void
    {
        try {
            $this->sqsClient->sendMessage($this->getSqsParams($queueParamsDto));
        } catch (AwsException $exception) {
            error_log($exception->getMessage());
        }
    }

    private function getSqsParams(QueueParamsDto $queueParamsDto): array
    {
        return [
            'DelaySeconds' => 10,
            'MessageAttributes' => [
                "Key" => [
                    'DataType' => "String",
                    'StringValue' => $queueParamsDto->fileKey
                ],
                "SenderEmail" => [
                    'DataType' => "String",
                    'StringValue' => $queueParamsDto->authorEmail
                ],
            ],
            'MessageBody' => "File uploaded",
            'QueueUrl' => $_ENV['SQS_GEOCODE_AVAILABLE_FILES_URL']
        ];
    }
}

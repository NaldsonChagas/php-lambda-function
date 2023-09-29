<?php

namespace Naldson\LambdaSaveFile\Clients;

use Aws\S3\ObjectUploader;
use Aws\S3\S3Client;
use Naldson\LambdaSaveFile\Exceptions\UploadException;

readonly class ProjectS3Client implements UploaderClient
{
    private S3Client $s3Client;

    public function __construct()
    {
        $this->s3Client = new S3Client([
            'profile' =>  $_ENV['S3_CLIENT_PROFILE'],
            'region' =>  $_ENV['S3_CLIENT_REGION'],
            'version' =>  $_ENV['S3_CLIENT_VERSION']
        ]);
    }

    public function upload(string $file): void
    {
        $bucket =  $_ENV['S3_CLIENT_BUCKET'];
        $key = 'coordinates-file'.time().'.csv';

        $uploader = new ObjectUploader(
            $this->s3Client,
            $bucket,
            $key,
            base64_decode($file)
        );

        $result = $uploader->upload();

        if ($result["@metadata"]["statusCode"] != '200') {
            throw new UploadException('Cannot upload file to S3');
        }
    }
}

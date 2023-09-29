<?php

namespace ReverseGeocode\SaveFile\Clients;

use Aws\Exception\MultipartUploadException;
use Aws\S3\ObjectUploader;
use Aws\S3\S3Client;
use ReverseGeocode\SaveFile\Exceptions\UploadException;

readonly class ProjectS3Client implements UploaderClient
{
    private S3Client $s3Client;

    public function __construct()
    {
        $this->s3Client = new S3Client([
            'region' =>  $_ENV['S3_CLIENT_REGION'],
            'version' =>  $_ENV['S3_CLIENT_VERSION'],
            'credentials' => [
                'key' => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ]
        ]);
    }

    public function upload(string $file): string
    {
        $bucket =  $_ENV['S3_CLIENT_BUCKET'];
        $key = 'coordinates-file'.time().'.csv';

        $uploader = new ObjectUploader(
            $this->s3Client,
            $bucket,
            $key,
            base64_decode($file)
        );

        try {
            $uploader->upload();
            return $key;
        } catch (MultipartUploadException $exception) {
            error_log($exception->getMessage());
            throw new UploadException('Cannot upload file to S3 '. $exception->getMessage());
        }
    }
}

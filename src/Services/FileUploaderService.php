<?php

namespace Naldson\LambdaSaveFile\Services;

use Naldson\LambdaSaveFile\Clients\UploaderClient;

readonly class FileUploaderService
{
    private UploaderClient $uploaderClient;

    public function __construct(UploaderClient $uploaderClient)
    {
        $this->uploaderClient = $uploaderClient;
    }

    public function uploadAndNotify(string $file): void
    {
        $this->uploaderClient->upload($file);
    }
}
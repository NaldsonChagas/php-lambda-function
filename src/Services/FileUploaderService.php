<?php

namespace ReverseGeocode\SaveFile\Services;

use ReverseGeocode\SaveFile\Clients\UploaderClient;

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
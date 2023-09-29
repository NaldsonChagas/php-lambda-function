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

    public function upload(string $file): string
    {
        return $this->uploaderClient->upload($file);
    }
}

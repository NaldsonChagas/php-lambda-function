<?php

namespace ReverseGeocode\SaveFile\Services;

use ReverseGeocode\SaveFile\Clients\NotifierClient;
use ReverseGeocode\SaveFile\Clients\UploaderClient;
use ReverseGeocode\SaveFile\Domains\Dtos\QueueParamsDto;

readonly class FileUploaderService
{
    private UploaderClient $uploaderClient;
    private NotifierClient $notifierClient;

    public function __construct(UploaderClient $uploaderClient, NotifierClient $notifierClient)
    {
        $this->uploaderClient = $uploaderClient;
        $this->notifierClient = $notifierClient;
    }

    public function uploadAndNotify(string $file, string $email): void
    {
        $fileKey = $this->uploaderClient->upload($file);
        $this->notifierClient->notify(new QueueParamsDto($fileKey, $email));
    }
}

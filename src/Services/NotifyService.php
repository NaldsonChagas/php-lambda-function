<?php

namespace ReverseGeocode\SaveFile\Services;

use ReverseGeocode\SaveFile\Clients\NotifierClient;
use ReverseGeocode\SaveFile\Domains\Dtos\QueueParamsDto;

readonly class NotifyService
{
    private NotifierClient $notifierClient;

    public function __construct(NotifierClient $notifierClient)
    {
        $this->notifierClient = $notifierClient;
    }

    public function notify($fileKey, $email): void
    {
        $this->notifierClient->notify(new QueueParamsDto($fileKey, $email));
    }
}

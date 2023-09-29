<?php

namespace ReverseGeocode\SaveFile\Clients;

use ReverseGeocode\SaveFile\Domains\Dtos\QueueParamsDto;

interface  NotifierClient
{
    public function notify(QueueParamsDto $queueParamsDto): void;
}
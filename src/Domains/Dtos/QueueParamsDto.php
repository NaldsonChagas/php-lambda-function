<?php

namespace ReverseGeocode\SaveFile\Domains\Dtos;

readonly class QueueParamsDto
{
    public readonly string $fileKey;
    public readonly string $authorEmail;

    public function __construct(string $fileKey, string $authorEmail)
    {
        $this->fileKey = $fileKey;
        $this->authorEmail = $authorEmail;
    }
}
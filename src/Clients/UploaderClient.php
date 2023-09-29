<?php

namespace ReverseGeocode\SaveFile\Clients;

interface UploaderClient {
    function upload(string $file);
}

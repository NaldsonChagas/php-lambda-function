<?php

namespace Naldson\LambdaSaveFile\Clients;

interface UploaderClient {
    function upload(string $file);
}

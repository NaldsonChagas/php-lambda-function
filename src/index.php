<?php

require 'vendor/autoload.php';

function index($input)
{
    return \Naldson\LambdaSaveFile\Utils\Response::apiResponse('hello world');
}

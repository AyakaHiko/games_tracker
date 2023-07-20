<?php

namespace App\Services\Interfaces;

interface IHttpService
{
    public function makeRequest($method, $url, $headers = [], $params = []);
}

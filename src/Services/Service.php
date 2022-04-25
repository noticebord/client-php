<?php

namespace Noticebord\Client\Services;

use GuzzleHttp\Client;

abstract class Service
{
    public const DEFAULT_BASE_URL = "https://noticebord.space/api";

    protected Client $client;

    public function __construct(
        protected string $token = '',
        protected string $baseUrl = self::DEFAULT_BASE_URL
    ) {

        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $this->token"
            ],
        ]);
    }
}

<?php

namespace Noticebord\Client\Services;

use GuzzleHttp\{Client, RequestOptions};
use Noticebord\Client\Models\AuthenticateRequest;

class TokenService
{
    public static function getToken(string $baseUrl, AuthenticateRequest $request): string
    {
        $client = new Client(['base_uri' => $baseUrl]);
        return $client
            ->post('tokens', [RequestOptions::JSON => $request])
            ->getBody()
            ->getContents();
    }
}

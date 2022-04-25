<?php

namespace Noticebord\Client\Requests;

class AuthenticateRequest
{
    public function __construct(
        public string $email,
        public string $password,
        public string $deviceName
    ) {
    }
}

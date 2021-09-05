<?php

namespace Noticebord\Client\Models;

class AuthenticateRequest
{
    public function __construct(
        public string $email,
        public string $password,
        public string $device_name
    ) {
    }
}

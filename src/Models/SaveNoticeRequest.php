<?php

namespace Noticebord\Client\Models;

class SaveNoticeRequest
{
    public function __construct(
        public string $title,
        public string $body,
        public bool $anonymous,
        public bool $public
    ) {
    }
}

<?php

namespace Noticebord\Client\Models;

use DateTime;

class Notice
{
    public string $title;
    public ?string $body;
    public DateTime $created_at;
    public DateTime $updated_at;
    public ?User $author;
}

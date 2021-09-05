<?php

namespace Noticebord\Client\Transformers;

use Karriere\JsonDecoder\{
    Bindings\DateTimeBinding,
    Bindings\FieldBinding,
    ClassBindings,
    Transformer
};
use Noticebord\Client\Models\{Notice, User};

class NoticeTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new FieldBinding('author', 'author', User::class));
        $classBindings->register(new DateTimeBinding('created_at', 'created_at', dateTimeFormat: 'Y-m-d\TH:i:s.u\Z'));
        $classBindings->register(new DateTimeBinding('updated_at', 'updated_at', dateTimeFormat: 'Y-m-d\TH:i:s.u\Z'));
    }

    public function transforms()
    {
        return Notice::class;
    }
}

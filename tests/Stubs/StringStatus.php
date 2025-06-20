<?php

namespace Tests\Stubs;

enum StringStatus: string
{
    case draft = 'draft';
    case pending = 'pending';
    case done = 'done';
}

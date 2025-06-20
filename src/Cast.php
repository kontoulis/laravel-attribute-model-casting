<?php
namespace Kontoulis\LaravelAttributeModelCasting;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

#[\Attribute(\Attribute::TARGET_CLASS|\Attribute::IS_REPEATABLE)]
class Cast
{
    public function __construct(private string $property, private string $castClass)
    {
    }
}
<?php

namespace Tests\Stubs;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Price implements Castable
{
    public function __construct(public float $amount, public string $currency)
    {
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes
        {
            public function get(Model $model, string $key, mixed $value, array $attributes): Price
            {
                return new Price($attributes['amount'], $attributes['currency']);
            }

            public function set(Model $model, string $key, mixed $value, array $attributes): array
            {
                return [
                    'amount' => $value->amount,
                    'currency' => $value->currency,
                ];
            }
        };
    }
}

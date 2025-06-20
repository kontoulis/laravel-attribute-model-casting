<?php

namespace Tests\Stubs;

use Kontoulis\LaravelAttributeModelCasting\Cast;

#[Cast('price', Price::class)]
trait HasPrice
{
    public function priceEquals(Price $other): bool
    {
        return $this->amount === $other->amount && $this->currency === $other->currency;
    }
}

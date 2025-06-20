<?php
namespace Kontoulis\LaravelAttributeModelCasting;

use ReflectionClass;

trait AttributeCasting
{
    protected function initializeAttributeCasting(): void
    {
        $this->casts = array_merge($this->casts, $this->castsFromCastAttribute());
    }

    /**
     * Get the class and its traits Cast attributes.
     */
    protected function castsFromCastAttribute(): array
    {
        $reflected = new ReflectionClass($this);

        return collect($reflected->getAttributes(Cast::class))
            ->merge(collect($reflected->getTraits())
                ->map(fn ($trait) => $trait->getAttributes(Cast::class))
                ->filter()
                ->flatten()
            )
            ->mapWithKeys(fn ($attribute) => [$attribute->getArguments()[0] => $attribute->getArguments()[1]])
            ->all();
    }
}
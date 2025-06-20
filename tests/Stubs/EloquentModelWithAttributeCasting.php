<?php

namespace Tests\Stubs;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsEncryptedCollection;
use Illuminate\Database\Eloquent\Casts\AsEnumArrayObject;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Model;
use Kontoulis\LaravelAttributeModelCasting\AttributeCasting;
use Kontoulis\LaravelAttributeModelCasting\Cast;

#[Cast('floatAttribute', 'float')]
#[Cast('boolAttribute', 'bool')]
#[Cast('booleanAttribute', 'boolean')]
#[Cast('objectAttribute', 'object')]
#[Cast('jsonAttribute', 'json')]
#[Cast('dateAttribute', 'date')]
#[Cast('timestampAttribute', 'timestamp')]
#[Cast('collectionAttribute', AsCollection::class)]
#[Cast('customCollectionAsArrayAttribute', [AsCollection::class, CustomCollection::class])]
#[Cast('encryptedCollectionAttribute', AsEncryptedCollection::class)]
#[Cast('enumCollectionAttribute', AsEnumCollection::class.':'.StringStatus::class)]
#[Cast('enumArrayObjectAttribute', AsEnumArrayObject::class.':'.StringStatus::class)]
#[Cast('intAttribute', 'int')]
#[Cast('stringAttribute', 'string')]
#[Cast('arrayAttribute', 'array')]
class EloquentModelWithAttributeCasting extends Model
{
    use AttributeCasting;
    use HasPrice;

    protected $casts = [
        'datetimeAttribute' => 'datetime',
    ];

    protected function casts()
    {
        return [
            'duplicateIntAttribute' => 'int',
        ];
    }

    public function jsonAttributeValue()
    {
        return $this->attributes['jsonAttribute'];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace Tests\Unit;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use stdClass;
use Tests\Stubs\CustomCollection;
use Tests\Stubs\EloquentModelWithAttributeCasting;
use Tests\Stubs\Price;
use Tests\TestCase;

class AttributeCastingTest extends TestCase
{
    public function testModelAttributesAreCastedWhenCastedByAttribute(): void
    {
        $model = new EloquentModelWithAttributeCasting();
        $model->setDateFormat('Y-m-d H:i:s');
        $model->intAttribute = '3';
        $model->floatAttribute = '4.0';
        $model->stringAttribute = 2.5;
        $model->boolAttribute = 1;
        $model->booleanAttribute = 0;
        $model->objectAttribute = ['foo' => 'bar'];
        $obj = new stdClass;
        $obj->foo = 'bar';
        $model->arrayAttribute = $obj;
        $model->jsonAttribute = ['foo' => 'bar'];
        $model->dateAttribute = '1969-07-20';
        $model->datetimeAttribute = '1969-07-20 22:56:00';
        $model->timestampAttribute = '1969-07-20 22:56:00';
        $model->collectionAttribute = new Collection;
        $model->asCustomCollectionAttribute = new CustomCollection;
        $model->duplicateIntAttribute = '5.0';

        // From trait
        $model->price = new Price(100.5, 'USD');

        $this->assertIsInt($model->intAttribute);
        $this->assertIsFloat($model->floatAttribute);
        $this->assertIsString($model->stringAttribute);
        $this->assertIsBool($model->boolAttribute);
        $this->assertIsBool($model->booleanAttribute);
        $this->assertIsObject($model->objectAttribute);
        $this->assertIsArray($model->arrayAttribute);
        $this->assertIsArray($model->jsonAttribute);
        $this->assertTrue($model->boolAttribute);
        $this->assertFalse($model->booleanAttribute);
        $this->assertEquals($obj, $model->objectAttribute);
        $this->assertEquals(['foo' => 'bar'], $model->arrayAttribute);
        $this->assertEquals(['foo' => 'bar'], $model->jsonAttribute);
        $this->assertSame('{"foo":"bar"}', $model->jsonAttributeValue());
        $this->assertInstanceOf(Carbon::class, $model->dateAttribute);
        $this->assertInstanceOf(Carbon::class, $model->datetimeAttribute);
        $this->assertInstanceOf(Collection::class, $model->collectionAttribute);
        $this->assertInstanceOf(CustomCollection::class, $model->asCustomCollectionAttribute);
        $this->assertSame('1969-07-20', $model->dateAttribute->toDateString());
        $this->assertSame('1969-07-20 22:56:00', $model->datetimeAttribute->toDateTimeString());
        $this->assertEquals(-14173440, $model->timestampAttribute);
        $this->assertEquals(5, $model->duplicateIntAttribute);
        $this->assertInstanceOf(Price::class, $model->price);

        $arr = $model->toArray();

        $this->assertIsInt($arr['intAttribute']);
        $this->assertIsFloat($arr['floatAttribute']);
        $this->assertIsString($arr['stringAttribute']);
        $this->assertIsBool($arr['boolAttribute']);
        $this->assertIsBool($arr['booleanAttribute']);
        $this->assertIsObject($arr['objectAttribute']);
        $this->assertIsArray($arr['arrayAttribute']);
        $this->assertIsArray($arr['jsonAttribute']);
        $this->assertIsArray($arr['collectionAttribute']);
        $this->assertTrue($arr['boolAttribute']);
        $this->assertFalse($arr['booleanAttribute']);
        $this->assertEquals($obj, $arr['objectAttribute']);
        $this->assertEquals(['foo' => 'bar'], $arr['arrayAttribute']);
        $this->assertEquals(['foo' => 'bar'], $arr['jsonAttribute']);
        $this->assertSame('1969-07-20 00:00:00', $arr['dateAttribute']);
        $this->assertSame('1969-07-20 22:56:00', $arr['datetimeAttribute']);
        $this->assertEquals(-14173440, $arr['timestampAttribute']);
        $this->assertEquals(5, $arr['duplicateIntAttribute']);
        $this->assertEquals(100.5, $arr['amount']);
        $this->assertEquals('USD', $arr['currency']);
    }
}

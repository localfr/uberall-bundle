<?php

namespace Localfr\UberallBundle\Tests\Provider;

use Localfr\UberallBundle\Provider\UberallProvider;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UberallProviderTest extends TestCase
{
    protected $testedClass;

    public function setUp()
    {
        parent::setUp();

        $this->testedClass = new class extends UberallProvider {
            protected function getFieldNames(): array
            {
                return [
                    'goodOffset'
                ];
            }
        };
    }

    public function testOffsetExists()
    {
        $this->assertTrue($this->testedClass->offsetExists('goodOffset'));

        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('The offset wrongOffset does not exist.');
        $this->testedClass->offsetExists('wrongOffset');
    }

    public function testOffsetSetGetAndUnset()
    {
        $this->assertNull($this->testedClass->offsetGet('goodOffset'));

        $this->testedClass->offsetSet('goodOffset', true);
        $this->assertTrue($this->testedClass->offsetGet('goodOffset'));

        $this->testedClass->offsetUnset('goodOffset');
        $this->assertNull($this->testedClass->offsetGet('goodOffset'));

        $this->testedClass->__set('goodOffset', true);
        $this->assertTrue($this->testedClass->__get('goodOffset'));

        $this->testedClass->offsetUnset('goodOffset');
        $this->assertNull($this->testedClass->offsetGet('goodOffset'));
        $this->testedClass->setData(['goodOffset' => true]);
        $this->assertTrue($this->testedClass->offsetGet('goodOffset'));

        $this->testedClass->addData(['goodOffset' => false]);
        $this->assertFalse($this->testedClass->offsetGet('goodOffset'));
    }
}

<?php

use F\Maybe;

class MapTest extends PHPUnit_Framework_TestCase
{
    public function testWorksOnAnArray()
    {
        $triple = function ($x) { return $x * 3; };
        $this->assertSame([3, 6, 9], F\map($triple, [1, 2, 3]));
    }

    public function testWorksOnAMap()
    {
        $double = function ($x) { return $x * 2; };
        $this->assertSame(['me' => 2, 'you' => 20], F\map($double, ['me' => 1, 'you' => 10]));
    }

    public function testReliesOnTheFunctorsMapMethodIfItsPresent()
    {
        $this->assertEquals(Maybe::of('IKR'), F\map('strtoupper', Maybe::of('ikr')));
    }
}

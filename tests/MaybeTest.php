<?php

use F\Maybe;

class MaybeTest extends PHPUnit_Framework_TestCase
{
    public function testIsNothingPositive()
    {
        $this->assertTrue((new Maybe(null))->isNothing());
    }

    public function testIsNothingNegative()
    {
        $this->assertFalse((new Maybe('something'))->isNothing());
    }

    public function testOfFactory()
    {
        $this->assertEquals(new Maybe(42), Maybe::of(42));
    }

    public function testMapOnNothingYieldsNothing()
    {
        $this->assertEquals(new Maybe(null), Maybe::of(null)->map('strtoupper'));
    }

    public function testMapOnSomethingYieldsFOfSomething()
    {
        $this->assertEquals(new Maybe('HI'), Maybe::of('hi')->map('strtoupper'));
    }
}

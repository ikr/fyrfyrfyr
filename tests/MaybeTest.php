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

    public function testJoinOnNestedActuallyPresentValue()
    {
        $this->assertEquals(new Maybe(42), Maybe::of(Maybe::of(42))->join());
    }

    public function testJoinOnNestedAbsentValue()
    {
        $this->assertEquals(new Maybe(null), Maybe::of(Maybe::of(null))->join());
    }

    public function testChain1()
    {
        $this->assertEquals(
            Maybe::of(5),

            Maybe::of(3)->chain(
                function ($three)
                {
                    return Maybe::of(2)->map(F\C1\add($three));
                }
            )
        );
    }

    public function testChain2()
    {
        $this->assertEquals(
            Maybe::of(null),
            Maybe::of(null)->chain(F\C1\prop('address'))->chain(F\C1\prop('street'))
        );
    }
}

<?php

class MinByTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $square = function ($x) { return $x * $x; };
        $this->assertSame(2, F\minBy($square, -3, 2));
    }

    public function testHasPrecurriedVersionWithAnArityOfOne()
    {
        $this->assertSame(1, call_user_func(call_user_func(F\C1\minBy('F\inc'), 1), 5));
    }

    public function testHasPrecurriedVersionWithAnArityOfTwo()
    {
        $this->assertSame(0, call_user_func(F\C2\minBy('F\inc', 9), 0));
    }

    public function testCanBeUsedOnAListWithReduce()
    {
        $square = function ($x) { return $x * $x; };
        $this->assertSame(1, F\reduce(F\C1\minBy($square), -999999, [3, -5, 4, 1, -2]));
    }
}

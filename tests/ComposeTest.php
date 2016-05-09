<?php

class ComposeTest extends PHPUnit_Framework_TestCase
{
    public function testSomeMath()
    {
        $inc = function ($x) { return $x + 1; };
        $negate = function ($x) { return -$x; };

        $f = F\compose([$inc, $negate, 'pow']);
        $this->assertSame(-80, $f(3, 4));
    }

    public function testSomeText()
    {
        $exclaim = function ($x) { return "$x!"; };
        $shout = F\compose([$exclaim, 'strtoupper']);

        $this->assertSame('Y U NO COMPOSE!', $shout('y u no compose'));
    }
}

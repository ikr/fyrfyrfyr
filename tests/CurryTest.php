<?php

class CurryTest extends PHPUnit_Framework_TestCase
{
    public function testCurriedAdditionOnTwo()
    {
        $add = F\curry(
            function ($a, $b)
            {
                return $a + $b;
            }
        );

        $add10 = $add(10);

        $this->assertSame(13, $add10(3));
    }

    public function testCurriedAdditionOnThree()
    {
        $add = F\curry(
            function ($a, $b, $c)
            {
                return $a + $b + $c;
            }
        );

        $add1 = $add(1);
        $add12 = $add1(2);

        $this->assertSame(6, $add12(3));
    }
}

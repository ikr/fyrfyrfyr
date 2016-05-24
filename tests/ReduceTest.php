<?php

class ReduceTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(16, F\reduce('F\add', 10, [1, 2, 3]));
    }

    public function testHasPrecurriedVersionWithAnArityOfOne()
    {
        $this->assertSame(
            3,
            call_user_func(
                call_user_func(
                    F\C1\reduce('F\add'),
                    0
                ),
                [1, 2]
            )
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfTwo()
    {
        $this->assertSame(
            3,
            call_user_func(
                F\C2\reduce('F\add', 1),
                [1, 1]
            )
        );
    }
}

<?php

class AssocTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(
            ['a' => 1, 'b' => 2, 'c' => 3],
            F\assoc('c', 3, ['a' => 1, 'b' => 2])
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfOne()
    {
        $this->assertSame(
            ['yes' => 1],
            call_user_func(
                call_user_func(
                    F\C1\assoc('yes'),
                    1
                ),
                []
            )
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfTwo()
    {
        $this->assertSame(
            ['ja' => 2],
            call_user_func(
                F\C2\assoc('ja', 2),
                []
            )
        );
    }
}

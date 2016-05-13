<?php

class PickAllTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(
            ['a' => '', 'b' => '', 'c' => 'CC'],
            F\pickAll('', ['a', 'b', 'c'], ['c' => 'CC'])
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfOne()
    {
        $this->assertSame(
            ['missing' => true],
            call_user_func(
                call_user_func(
                    F\C1\pickAll(true),
                    ['missing']
                ),
                []
            )
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfTwo()
    {
        $this->assertSame(
            ['length' => -1],
            call_user_func(
                F\C2\pickAll(-1, ['length']),
                []
            )
        );
    }
}

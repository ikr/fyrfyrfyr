<?php

class MergeTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(
            ['foo' => 13, 'moo' => 11, 'goo' => 17],
            F\merge(['foo' => 1], ['moo' => 11, 'foo' => 13, 'goo' => 17])
        );
    }

    public function testHasPrecurriedVersion()
    {
        $this->assertSame(
            ['b' => 2, 'a' => 1],
            call_user_func(F\C1\merge(['b' => 2]), ['a' => 1])
        );
    }
}

<?php

class PickTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(['a' => 1], F\pick(['a', 'c'], ['a' => 1, 'b' => 2]));
    }

    public function testHasPrecurriedVersion()
    {
        $this->assertSame(
            ['name' => 'Bob', 'age' => 3],
            call_user_func(
                F\C1\pick(['name', 'age', 'nickname']),
                ['age' => 3, 'name' => 'Bob', 'z-order' => -256, 'hash' => 'ffad6d78']
            )
        );
    }
}

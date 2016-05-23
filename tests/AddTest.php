<?php

class AddTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(7, F\add(4, 3));
    }

    public function testHasPrecurriedVersion()
    {
        $this->assertSame(4, call_user_func(F\C1\add(2), 2));
    }
}
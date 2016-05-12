<?php

class AppendTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(['a', 'z'], F\append('z', ['a']));
    }

    public function testHasPrecurriedVersion()
    {
        $this->assertSame([7], call_user_func(F\C1\append(7), []));
    }
}

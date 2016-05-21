<?php

class AlwaysTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(['badaboom'], call_user_func(F\always(['badaboom'])));
    }
}
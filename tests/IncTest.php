<?php

class IncTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(43, F\inc(42));
    }
}

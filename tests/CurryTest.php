<?php

class CurryTest extends PHPUnit_Framework_TestCase
{
    public function testNothing()
    {
        $this->assertNull(F\curry());
    }
}
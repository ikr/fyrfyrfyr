<?php

class IdentityTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(['what' => 'ever'], F\identity(['what' => 'ever']));
    }
}

<?php

class FromPairsTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(['a' => 1, 'b' => 2], F\fromPairs([['a', 1], ['b', 2]]));
    }
}

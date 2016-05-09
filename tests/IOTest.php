<?php

use F\IO;

class IOTest extends PHPUnit_Framework_TestCase
{
    public function testUnsafePerformIO()
    {
        $f = function () { return 'gorilla and the whole jungle'; };

        $this->assertSame(
            (new IO($f))->unsafePerformIO(), 'gorilla and the whole jungle');
    }

    public function testOfWrapsAValueIntoAThunk()
    {
        $this->assertSame(42, IO::of(42)->unsafePerformIO());
    }
}
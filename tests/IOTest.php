<?php

use F\IO;
use F\Maybe;

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
        $x = 42;
        $this->assertSame(42, IO::of($x)->unsafePerformIO());
    }

    public function testLinksToTheUnsafeValueByReference()
    {
        $promiscuous = 42;
        $io = IO::of($promiscuous);
        $promiscuous = 13;
        $this->assertSame(13, $io->unsafePerformIO());
    }

    public function testLinksToTheUnsafeMapValueByReference()
    {
        $promiscuous = ['foo' => 'bar'];
        $io = IO::of($promiscuous['foo']);
        $promiscuous['foo'] = 'moo';
        $this->assertSame('moo', $io->unsafePerformIO());
    }

    public function testMap()
    {
        $env = ['user' => 'ikr'];

        $io = IO::of($env)
            ->map(F\curry('F\prop', 'user'))
            ->map(F\curry('F\map', 'strtoupper'));

        $env['user'] = 'root';

        $this->assertEquals(Maybe::of('ROOT'), $io->unsafePerformIO());
    }

    public function testJoin()
    {
        $io0 = new IO(F\always(13));
        $io = IO::of($io0)->join();
        $this->assertSame(13, $io->unsafePerformIO());
    }

    public function testChain()
    {
        $v = 42;

        $echo = function ($x)
        {
            echo $x;
            return IO::of($x);
        };

        $io = IO::of($v)->chain($echo);

        ob_start();
        $ret = $io->unsafePerformIO();
        $out = ob_get_clean();

        $this->assertSame(42, $ret);
        $this->assertSame('42', $out);
    }
}

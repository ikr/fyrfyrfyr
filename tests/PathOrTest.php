<?php

class PathOrTest extends PHPUnit_Framework_TestCase
{
    public function testWorksWhenRequestedValueIsPresent()
    {
        $this->assertSame(2, F\pathOr(-1, ['a', 'b'], ['a' => ['b' => 2]]));
    }

    public function testWorksWhenRequestedValueIsAbsent()
    {
        $this->assertSame(-1, F\pathOr(-1, ['a', 'b'], ['c' => ['b' => 2]]));
    }

    public function testReternsTheDefaultWhenThePathIsEmpty()
    {
        $this->assertSame('', F\pathOr('', [], ['foo' => 'moo']));
    }

    public function testHasPrecurriedVersionWithAnArityOfOne()
    {
        $this->assertSame(
            false,

            call_user_func(
                call_user_func(
                    F\C1\pathOr(false),
                    ['boo', 'goo']
                ),
                ['boo' => ['loo' => true]]
            )
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfTwo()
    {
        $this->assertTrue(
            call_user_func(
                F\C2\pathOr(false, ['boo', 'loo']),
                ['boo' => ['loo' => true]]
            )
        );
    }
}

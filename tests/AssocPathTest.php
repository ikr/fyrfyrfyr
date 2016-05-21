<?php

class AssocPathTest extends PHPUnit_Framework_TestCase
{
    public function testRewritesPresentValue()
    {
        $this->assertSame(
            ['a' => ['b' => ['c' => 42]]],
            F\assocPath(['a', 'b', 'c'], 42, ['a' => ['b' => ['c' => 0]]])
        );
    }

    public function testBuildsUpTheStructureWhenValueIsAbsent()
    {
        $this->assertSame(
            ['a' => ['b' => ['c' => 42]]],
            F\assocPath(['a', 'b', 'c'], 42, [])
        );
    }

    public function testIdentityInTrivialCase()
    {
        $this->assertSame([], F\assocPath([], 0, []));
    }

    public function testWorksOnASingleLevel()
    {
        $this->assertEquals(
            ['a' => 'b', 'x' => 'y'], F\assocPath(['a'], 'b', ['x' => 'y']));
    }

    public function testHasPrecurriedVersionWithAnArityOfOne()
    {
        $this->assertSame(
            ['a' => ['b' => 1, 'c' => 2]],
            call_user_func(
                call_user_func(
                    F\C1\assocPath(['a', 'c']),
                    2
                ),
                ['a' => ['b' => 1]]
            )
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfTwo()
    {
        $this->assertSame(
            ['a' => ['b' => 1]],
            call_user_func(F\C2\assocPath(['a', 'b'], 1), ['a' => []])
        );
    }
}

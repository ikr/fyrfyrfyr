<?php

class IndexByTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertEquals(
            [
                'abc' => ['id' => 'abc', 'title' => 'B'],
                'xyz' => ['id' => 'xyz', 'title' => 'A']
            ],

            F\indexBy(
                F\C2\propOr('', 'id'),
                [
                    ['id' => 'xyz', 'title' => 'A'],
                    ['id' => 'abc', 'title' => 'B']
                ]
            )
        );
    }

    public function testHasACurriedVersion()
    {
        $this->assertSame(
            ['a' => ['b' => 1]],
            call_user_func(
                F\C1\indexBy(F\always('a')),
                [['b' => 1]]
            )
        );
    }
}

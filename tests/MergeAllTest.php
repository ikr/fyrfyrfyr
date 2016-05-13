<?php

class MergeAllTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $this->assertSame(
            ['foo' => 13, 'moo' => 11, 'goo' => 17, 'zoo' => 5, 'boo' => 19],
            F\mergeAll(
                [
                    ['foo' => 1],
                    ['moo' => 2, 'goo' => 3],
                    ['zoo' => 5, 'foo' => 7],
                    ['moo' => 11, 'foo' => 13, 'goo' => 17],
                    ['boo' => 19]
                ]
            )
        );
    }
}

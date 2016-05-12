<?php

class PropOrTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsKeysValueWhenItsPresent()
    {
        $this->assertSame(36, F\propOr(36, 'age', ['age' => 36]));
    }

    public function testReturnsTheProvidedDefaultValueWhenTheKeyIsMissing()
    {
        $this->assertSame(-1, F\propOr(-1, 'age', []));
    }

    public function testHasPrecurriedVersionWithAnArityOfOne()
    {
        $this->assertSame(
            1,
            call_user_func(
                call_user_func(
                    F\C1\propOr(1),
                    'boo'
                ),
                ['goo' => 4]
            )
        );
    }

    public function testHasPrecurriedVersionWithAnArityOfTwo()
    {
        $this->assertSame(
            4,
            call_user_func(
                F\C2\propOr(1, 'goo'),
                ['goo' => 4]
            )
        );
    }
}

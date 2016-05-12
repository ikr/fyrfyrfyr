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
}
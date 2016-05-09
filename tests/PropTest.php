<?php

use F\Maybe;

class PropTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsAMaybe()
    {
        $this->assertInstanceOf('F\Maybe', F\prop('name', ['name' => 'Ax', 'age' => 90]));
    }

    public function testReturnsValueByAnExistingKey()
    {
        $this->assertEquals(Maybe::of('Ax'), F\prop('name', ['name' => 'Ax', 'age' => 91]));
    }

    public function testReturnsNothingForAMissingKey()
    {
        $this->assertEquals(Maybe::of(null), F\prop('age', ['name' => 'Ax']));
    }
}

<?php

class ConvergeTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $add =function ($a, $b) { return $a + $b; };
        $mul =function ($a, $b) { return $a * $b; };
        $sub =function ($a, $b) { return $a - $b; };
        $add3 =function ($a, $b, $c) { return $a + $b +$c; };

        $this->assertSame(
            -3,
            call_user_func(F\converge($mul, [$add, $sub]), 1, 2)
        );

        $this->assertSame(
            4,
            call_user_func(F\converge($add3, [$mul, $add, $sub]), 1, 2)
        );
    }

    public function testHasPrecurriedVersion()
    {
        $join = function ($a, $b) { return "$a $b"; };

        $data = [
            'name' => [
                'first' => 'James',
                'last' => 'Bond'
            ],
            'code' => '007',
            'country' => 'UK'
        ];

        $this->assertSame(
            'James Bond 007',
            call_user_func(
                call_user_func(
                    F\C1\converge($join),
                    [
                        F\compose(
                            F\curry('implode', ' '),
                            'array_values',
                            F\C2\propOr('', 'name')
                        ),
                        F\C2\propOr('', 'code')
                    ]
                ),
                $data
            )
        );
    }
}

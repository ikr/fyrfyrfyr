<?php

namespace F;

class IO
{
    private $f;

    public function __construct($f)
    {
        $this->f = $f;
    }

    public function unsafePerformIO()
    {
        return call_user_func($this->f);
    }

    public static function of(&$x)
    {
        return new self(
            function () use (&$x)
            {
                return $x;
            }
        );
    }
}

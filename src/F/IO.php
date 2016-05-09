<?php

namespace F;

class IO
{
    private $f;

    public function __construct($f)
    {
        $this->f = $f;
    }

    // unsafePerformIO :: a
    public function unsafePerformIO()
    {
        return call_user_func($this->f);
    }

    // of :: a -> IO a
    public static function of(&$x)
    {
        return new self(
            function () use (&$x)
            {
                return $x;
            }
        );
    }

    // map :: (a -> b) -> IO b
    public function map($f)
    {
        return new self(compose([$f, $this->f]));
    }
}

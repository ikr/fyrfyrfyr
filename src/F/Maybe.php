<?php

namespace F;

class Maybe
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    // isNothing :: Boolean
    public function isNothing()
    {
        return is_null($this->value);
    }

    // of :: a -> Maybe a
    public static function of($value)
    {
        return new Maybe($value);
    }

    // map :: (a -> b) -> Maybe b
    public function map($f)
    {
        return (
            $this->isNothing() ?
            self::of(null) :
            self::of(call_user_func($f, $this->value))
        );
    }

    // join :: Maybe a
    public function join()
    {
        return $this->isNothing() ? self::of(null) : $this->value;
    }

    // chain :: (a -> b) -> Maybe b
    public function chain($f)
    {
        return $this->map($f)->join();
    }
}

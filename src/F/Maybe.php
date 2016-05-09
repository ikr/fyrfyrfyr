<?php

namespace F;

class Maybe
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function isNothing()
    {
        return is_null($this->value);
    }

    public static function of($value)
    {
        return new Maybe($value);
    }

    public function map($f)
    {
        return $this->isNothing() ? self::of(null) : self::of(call_user_func($f, $this->value));
    }
}

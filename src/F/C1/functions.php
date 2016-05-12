<?php

namespace F\C1;

// map :: Functor f => (a -> b) -> f a -> f b
function map($f)
{
    return \F\curry('F\map', $f);
}

<?php

namespace F\C1;

// map :: Functor f => (a -> b) -> f a -> f b
function map($f) { return \F\curry('F\map', $f); }

// propOr :: a -> String -> {s: a} -> a
function propOr($default) { return \F\curry('F\propOr', $default); }

// append :: a -> [a] -> [a]
function append($element) { return \F\curry('F\append', $element); }

//pick :: [k] -> {k: v} -> {k: v}
function pick(array $keys) { return \F\curry('F\pick', $keys); }

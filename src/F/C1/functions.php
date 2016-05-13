<?php

namespace F\C1;

// map :: Functor f => (a -> b) -> f a -> f b
function map($f) { return \F\curry('F\map', $f); }

// propOr :: a -> String -> {s: a} -> a
function propOr($default) { return \F\curry('F\propOr', $default); }

// append :: a -> [a] -> [a]
function append($element) { return \F\curry('F\append', $element); }

// pickAll :: a -> [k] -> {k: v} -> {k: v}
function pickAll($default) { return \F\curry('F\pickAll', $default); }

//pick :: [k] -> {k: v} -> {k: v}
function pick(array $keys) { return \F\curry('F\pick', $keys); }

// merge :: {k: v} -> {k: v} -> {k: v}
function merge(array $a) { return \F\curry('F\merge', $a); }

// assoc :: String -> a -> {k: v} -> {k: v}
function assoc($k) { return \F\curry('F\assoc', $k); }

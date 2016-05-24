<?php

namespace F\C2;

// reduce :: ((a, b) -> a) -> a -> [b] -> a
function reduce($iterFn, $initial) { return \F\curry('F\reduce', $iterFn, $initial); }

// propOr :: a -> String -> {s: a} -> a
function propOr($default, $name) { return \F\curry('F\propOr', $default, $name); }

// pathOr :: a -> [String] -> Object -> a
function pathOr($default, array $pathElements)
{
    return \F\curry('F\pathOr', $default, $pathElements);
}

// pickAll :: a -> [k] -> {k: v} -> {k: v}
function pickAll($default, array $keys) { return \F\curry('F\pickAll', $default, $keys); }

// assoc :: String -> a -> {k: v} -> {k: v}
function assoc($k, $v) { return \F\curry('F\assoc', $k, $v); }

// assocPath :: [String] -> a -> {k: v} -> {k: v}
function assocPath(array $pathElements, $value) {
    return \F\curry('F\assocPath', $pathElements, $value);
}

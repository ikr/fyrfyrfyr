<?php

namespace F\C2;

// propOr :: a -> String -> {s: a} -> a
function propOr($default, $name) { return \F\curry('F\propOr', $default, $name); }

// pickAll :: a -> [k] -> {k: v} -> {k: v}
function pickAll($default, array $keys) { return \F\curry('F\pickAll', $default, $keys); }

// assoc :: String -> a -> {k: v} -> {k: v}
function assoc($k, $v) { return \F\curry('F\assoc', $k, $v); }

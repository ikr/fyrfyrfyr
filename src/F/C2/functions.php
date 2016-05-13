<?php

namespace F\C2;

// propOr :: a -> String -> {s: a} -> a
function propOr($default, $name) { return \F\curry('F\propOr', $default, $name); }

// assoc :: String -> a -> {k: v} -> {k: v}
function assoc($k, $v) { return \F\curry('F\assoc', $k, $v); }

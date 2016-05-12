<?php

namespace F\C2;

// propOr :: a -> String -> {s: a} -> a
function propOr($default, $name) { return \F\curry('F\propOr', $default, $name); }

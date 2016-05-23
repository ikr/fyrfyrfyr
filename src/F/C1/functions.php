<?php

namespace F\C1;

// map :: Functor f => (a -> b) -> f a -> f b
function map($f) { return \F\curry('F\map', $f); }

// prop :: s -> {s: a} -> Maybe a
function prop($name) { return \F\curry('F\prop', $name); }

// propOr :: a -> String -> {s: a} -> a
function propOr($default) { return \F\curry('F\propOr', $default); }

// pathOr :: a -> [String] -> Object -> a
function pathOr($default) { return \F\curry('F\pathOr', $default); }

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

// assocPath :: [String] -> a -> {k: v} -> {k: v}
function assocPath(array $pathElements) { return \F\curry('F\assocPath', $pathElements); }

// converge :: (x1 → x2 → … → z) → [(a → b → … → x1), (a → b → … → x2), …] → (a → b → … → z)
function converge($convergingFn) { return \F\curry('F\converge', $convergingFn); }

// indexBy :: (a -> String) -> [{k: v}] -> {k: {k: v}}
function indexBy($genKey) { return \F\curry('F\indexBy', $genKey); }

// add :: Number -> Number -> Number
function add($x) { return \F\curry('F\add', $x); }

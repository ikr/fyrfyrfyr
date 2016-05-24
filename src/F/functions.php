<?php

namespace F;

// curry :: (* -> a) -> (* -> a)
function curry($f)
{
    $args = array_slice(func_get_args(), 1);

    $meta = new \ReflectionFunction($f);

    return call_user_func_array(
        'F\curryN',
        array_merge(
            [$meta->getNumberOfRequiredParameters(), $f],
            $args
        )
    );
}

// curryN :: Number -> (* -> a) -> (* -> a)
function curryN($arity, $f)
{
    $args = array_slice(func_get_args(), 2);

    $accumulate = function (array $appliedArgs, $totalArgsCount) use ($f, $args, &$accumulate)
    {
        if (count($appliedArgs) + count($args) >= $totalArgsCount) {
            return call_user_func_array($f, array_merge($args, $appliedArgs));
        }

        return function ($x) use (&$accumulate, $appliedArgs, $totalArgsCount)
        {
            $append = function ($item, array $list)
            {
                $list[] = $item;
                return $list;
            };

            return $accumulate($append($x, $appliedArgs), $totalArgsCount);
        };
    };

    return $accumulate([], $arity);
}

// compose :: ((y -> z), (x -> y), ..., (o -> p), ((a, b, ..., n) -> o)) -> ((a, b, ..., n) -> z)
function compose()
{
    $fs = func_get_args();

    return function () use ($fs)
    {
        $args = func_get_args();

        foreach (array_reverse($fs) as $f) {
            $args = [call_user_func_array($f, $args)];
        }

        return $args[0];
    };
}

// flip :: (a -> b -> c -> … -> z) -> (b -> a -> c -> … -> z)
function flip($fn)
{
    return function ($x, $y) use ($fn)
    {
        $rest = array_slice(func_get_args(), 2);
        return call_user_func_array($fn, array_merge([$y, $x], $rest));
    };
}

// map :: Functor f => (a -> b) -> f a -> f b
function map($f, $functor)
{
    return method_exists($functor, 'map') ? $functor->map($f) : array_map($f, $functor);
}

// reduce :: ((a, b) -> a) -> a -> [b] -> a
function reduce($iterFn, $initial, array $xs) { return array_reduce($xs, $iterFn, $initial); }

// prop :: s -> {s: a} -> Maybe a
function prop($name, array $valuesByKey)
{
    return new Maybe(isset($valuesByKey[$name]) ? $valuesByKey[$name] : null);
}

// propOr :: a -> String -> {s: a} -> a
function propOr($default, $name, array $valuesByKey)
{
    return isset($valuesByKey[$name]) ? $valuesByKey[$name] : $default;
}

// pickAll :: a -> [k] -> {k: v} -> {k: v}
function pickAll($default, array $keys, array $valuesByKey)
{
    $base = array_combine($keys, array_fill(0, count($keys), $default));
    return array_merge($base, pick($keys, $valuesByKey));
}

// pathOr :: a -> [String] -> Object -> a
function pathOr($default, array $pathElements, $obj)
{
    if (!$pathElements) return $default;

    $pointer = $obj;
    while ($pathElements) {
        $key = array_shift($pathElements);
        if (!isset($pointer[$key])) return $default;
        $pointer = $pointer[$key];
    }

    return $pointer;
}

// pick :: [k] -> {k: v} -> {k: v}
function pick(array $keys, array $valuesByKey)
{
    return array_reduce(
        $keys,
        function ($memo, $key) use ($valuesByKey)
        {
            return array_merge(
                $memo,
                isset($valuesByKey[$key]) ? [$key => $valuesByKey[$key]] : []
            );
        },
        []
    );
}

// mergeAll :: [{k: v}] -> {k: v}
function mergeAll(array $as) { return call_user_func_array('array_merge', $as); }

// merge :: {k: v} -> {k: v} -> {k: v}
function merge(array $a1, array $a2) { return array_merge($a1, $a2); }

// assoc :: String -> a -> {k: v} -> {k: v}
function assoc($k, $v, $valuesByKey) { return array_merge($valuesByKey, [$k => $v]); }

// assocPath :: [String] -> a -> {k: v} -> {k: v}
function assocPath(array $pathElements, $value, array $obj)
{
    if (!$pathElements) return $obj;

    $result = $obj;
    $pointer = &$result;

    while (count($pathElements) > 1) {
        $key = array_shift($pathElements);

        if (!isset($pointer[$key]) || !is_array($pointer[$key])) {
            $pointer[$key] = [];
        }

        $pointer = &$pointer[$key];
    }

    $pointer[$pathElements[0]] = $value;
    return $result;
}

// fromPairs :: [[k, v]] -> {k: v}
function fromPairs(array $pairs)
{
    $keys = array_map(function ($p) { return $p[0]; },  $pairs);
    $values = array_map(function ($p) { return $p[1]; },  $pairs);
    return array_combine($keys, $values);
}

// converge :: (x1 → x2 → … → z) → [(a → b → … → x1), (a → b → … → x2), …] → (a → b → … → z)
function converge($convergingFn, array $branchingFns)
{
    return function() use ($convergingFn, $branchingFns)
    {
        $args = func_get_args();

        $branches = array_map(
            function ($fn) use ($args) { return call_user_func_array($fn, $args); },
            $branchingFns
        );

        return call_user_func_array($convergingFn, $branches);
    };
}

// indexBy :: (a -> String) -> [{k: v}] -> {k: {k: v}}
function indexBy($genKey, array $objs)
{
    return array_reduce(
        $objs,
        function ($memo, $obj) use ($genKey)
        {
            $memo[$genKey($obj)] = $obj;
            return $memo;
        },
        []
    );
}

// always :: a -> (* -> a)
function always($x) { return function () use ($x) { return $x; }; }

// identity :: a -> a
function identity($x) { return $x; }

// inc :: Number -> Number
function inc($x) { return $x + 1; }

// add :: Number -> Number -> Number
function add($x, $y) { return $x + $y; }

// append :: a -> [a] -> [a]
function append($element, array $list) { return array_merge($list, [$element]); }

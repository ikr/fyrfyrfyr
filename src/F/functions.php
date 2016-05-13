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

// map :: Functor f => (a -> b) -> f a -> f b
function map($f, $functor)
{
    return method_exists($functor, 'map') ? $functor->map($f) : array_map($f, $functor);
}

// identity :: a -> a
function identity($x) { return $x; }

// inc :: Number -> Number
function inc($x) { return $x + 1; }

// append :: a -> [a] -> [a]
function append($element, array $list) { return array_merge($list, [$element]); }

// pickAll :: a -> [k] -> {k: v} -> {k: v}
function pickAll($default, array $keys, array $valuesByKey)
{
    $base = array_combine($keys, array_fill(0, count($keys), $default));
    return array_merge($base, pick($keys, $valuesByKey));
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

// fromPairs :: [[k, v]] -> {k: v}
function fromPairs(array $pairs)
{
    $keys = array_map(function ($p) { return $p[0]; },  $pairs);
    $values = array_map(function ($p) { return $p[1]; },  $pairs);
    return array_combine($keys, $values);
}

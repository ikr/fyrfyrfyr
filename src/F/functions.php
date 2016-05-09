<?php

namespace F;

// curry :: (* -> a) -> [a, b, ...] -> (* -> a)
function curry($f, array $args)
{
    $meta = new \ReflectionFunction($f);
    return curryN($meta->getNumberOfRequiredParameters(), $f, $args);
}

// curryN :: Number -> (* -> a) -> [a, b, ...] -> (* -> a)
function curryN($arity, $f, array $args)
{
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
function compose(array $fs)
{
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

// map :: Functor f => (a -> b) -> f a -> f b
function map($f, $functor)
{
    return method_exists($functor, 'map') ? $functor->map($f) : array_map($f, $functor);
}

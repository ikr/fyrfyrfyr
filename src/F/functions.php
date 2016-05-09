<?php

namespace F;

function curry($f, array $args)
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

    $meta = new \ReflectionFunction($f);
    return $accumulate([], $meta->getNumberOfParameters());
}

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

<?php

namespace F;

function curry($f)
{
    $accumulate = function (array $appliedArgs, $totalArgsCount) use ($f, &$accumulate)
    {
        if (count($appliedArgs) >= $totalArgsCount) {
            return call_user_func_array($f, $appliedArgs);
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

<?php

/**
 * Get an item from an array or object using "dot" notation.
 *
 * @param  mixed   $target
 * @param  string|array  $key
 * @param  mixed   $default
 * @return mixed
 */
function data_get($target, $key, $default = null)
{
    if (is_null($key)) {
        return $target;
    }

    $key = is_array($key) ? $key : explode('.', $key);

    foreach ($key as $segment) {
        if (is_array($target)) {
            if (! array_key_exists($segment, $target)) {
                return value($default);
            }

            $target = $target[$segment];
        } elseif ($target instanceof ArrayAccess) {
            if (! isset($target[$segment])) {
                return value($default);
            }

            $target = $target[$segment];
        } elseif (is_object($target)) {
            $method = 'get' . ucfirst($segment);
            
            if (isset($target->{$segment})) {
                $target = $target->{$segment};
            }
            elseif (is_callable([$target, $method])) {
                $target = $target->{$method}();
            }
            else {
                return value($default);
            }
        } else {
            return value($default);
        }
    }

    return $target;
}
<?php

function json_sort(string $json, bool $objects=true, bool $arrays=false): string
{
    // uses a recursive lambda
    $order = null;
    $order = function ($json) use (&$order, $objects, $arrays) { 
        // sort sub-trees
        foreach ($json as $key => $value) {
            if (is_array($value) || is_object($value)) {
                if (is_array($json)) {
                    $json[$key] = $order($value);
                } else {
                    $json->$key = $order($value);
                }
            }
        }
        // sort this array or object
        if ($arrays && is_array($json)) {
            usort($json,function ($a,$b) {
                return json_encode($a)<=>json_encode($b);
            });
        } elseif ($objects && is_object($json)) {
            $arr = (array) $json;
            uksort($arr,function ($a,$b) use ($arr) {
                return json_encode([$a => $arr[$a]])<=>json_encode([$b => $arr[$b]]);
            });
            $json = (object) $arr;
        }
        return $json;
    };
    return json_encode($order(json_decode($json)));
}
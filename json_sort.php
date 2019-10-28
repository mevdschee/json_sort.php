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
            ksort($arr);
            $json = (object) $arr;
        }
        return $json;
    };
    return json_encode($order(json_decode($json)));
}

//echo json_sort('{"id":10,"usr":{"uid":10,"gid":5,"roles":[3,1,2]},"cat":2}',true,false)."\n";
//echo json_sort('{"id":10,"usr":{"uid":10,"gid":5,"roles":[3,1,2]},"cat":2}',false,true)."\n";
//echo json_sort('{"id":10,"usr":{"uid":10,"gid":5,"roles":[3,1,2]},"cat":2}',true,true)."\n";

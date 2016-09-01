<?php

namespace Popnikos\ScalarValidator\StringNormalizer;

class StudlyCapsNormalizer
{
    private function purify($string)
    {
        return preg_replace('/[^0-9A-Za-z]+/', ' ',$string);
    }

    private function split($string) 
    {
        return explode(' ', $string);
    }
    
    public static function normalizeWord($string)
    {
        return ucfirst(strtolower($string));
    }
    
    /**
     * @param string $value Any string
     * @return string A string in StudlyCaps
     */
    final public static function normalize($value)
    {
        $normalizer = new self();
        return implode('',array_map(array($normalizer,'normalizeWord'),$normalizer->split($normalizer->purify($value)));
    } 
}

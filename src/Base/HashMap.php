<?php 
declare(strict_types=1);
namespace XMLView\Base;

class HashMap
{
    private $map=[];
    
    function put($p_key,$p_value)
    {
        $this->map[$p_key]=$p_value;
    }
    
    function get($p_key)
    {
        if(array_key_exists($p_key,$this->map)){
            return $this->map[$p_key];
        } else {
            throw new UnkownKeyException($p_key);
        }
    }
    
    function has($p_key)
    {
        return array_key_exists($p_key,$this->map);
    }
}
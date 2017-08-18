<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;


use XMLView\Base\Base;

class MapData extends Base implements DataStore
{
    private $store=[];
    private $parent;
    
    function __construct(?MapData $p_parent,Array $p_data=[])
    {
        $this->parent=$p_parent;    
        $this->store=$p_data;
    }
    
    function getParent():DataStore
    {
        return $this->parent;
    }
    
    function getValue(string $p_name)
    {
        if(array_key_exists($p_name,$this->store)){
            return $this->store[$p_name];
        }
        if($this->parent){
            return $this->parent->getValue($p_name);
        }
        throw new DataNotFoundException($p_name);
    }
    
    function setValue(string $p_name,$p_value):void{
        $this->store[$p_name]=$p_value;
    }
    
    function setValues(Array $p_values):void{
        $this->store=array_merge($this->store,$p_value);
    }
}
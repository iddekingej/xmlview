<?php
declare(strict_types=1);
namespace XMLView\Engine\Data;

use XMLView\Base\Base;

class DataItemStore extends Base implements DataStore
{
    private $object;
    private $parent;
    private $store=[];
    
    function __construct(DataStore $p_parent,$p_object){
        $this->parent=$p_parent;
        $this->object=$p_object;
    }
    
    function getParent():?DataStore
    {
        return $this->parent;        
    }
    
    function getValue(string $p_name)
    {
        $l_method="get${p_name}";
        if(method_exists($this->object,$l_method)){
            return $this->object->$l_method();
        }
        if(isset($this->object->$p_name)){
            return $this->object->$p_name;
        }
        if(array_key_exists($p_name,$this->store)){
            return $this->store[$p_name];
        }
        if($this->parent){
            return $this->parent->getValue($p_name);
        }
        throw new DataNotFoundException($p_name);
    }
    
    function setValue(string $p_name,$p_value):void
    {
        $this->store[$p_name]=$p_value;
    }
    
    function setValues(Array $p_values):void
    {
        $this->store=array_merge($this->store,$p_values);
    }
    
}
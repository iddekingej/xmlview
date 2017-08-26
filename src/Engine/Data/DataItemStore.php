<?php
declare(strict_types=1);
namespace XMLView\Engine\Data;

use XMLView\Base\Base;
/**
 * Data used by the components are stored in a DataStore (@see DataStore)
 * 
 * This class can be used when the data can be directly read from a object.
 * It is also possible to add data, these are stored in a hashmap.
 * 
 * First it tries to read the value from the object
 * - Checks first if there is a method object->get<varname> (object->getName())
 * - Checks if there is a public property oject->varname (object->name)
 * If it doesn't exists
 * - Checks if the data is inside hasmap ($store propertie).
 * Checks the parent
 * If not found a exception is raised 
 */
class DataItemStore extends Base implements DataStore
{
    private $object;
    private $parent;
    private $store=[];
    
    /**
     * Construct the object
     * 
     * @param DataStore $p_parent  Parent store.
     * @param unknown $p_object    Source of the data.
     */
    function __construct(?DataStore $p_parent,$p_object){
        $this->parent=$p_parent;
        $this->object=$p_object;
    }
    /**
     * Get the parent  store
     */
    function getParent():?DataStore
    {
        return $this->parent;        
    }
    
    /**
     * Get the value from the store
     */
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
    /**
     * Data in this store is stored in an object and in a hashmap.
     * The data in object is read only. This method only sets the data in the 
     * hashmap and doesn't alter the object. 
     * 
     * @param string $p_name    Name of the variable
     * @param unkown $p_value   Value to store
     */
    function setValue(string $p_name,$p_value):void
    {
        $this->store[$p_name]=$p_value;
    }
    
    /**
     * Set values by associative array
     * 
     */
    function setValues(Array $p_values):void
    {
        $this->store=array_merge($this->store,$p_values);
    }
    
}
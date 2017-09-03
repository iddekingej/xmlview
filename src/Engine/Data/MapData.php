<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;


use XMLView\Base\Base;

/**
 * Data used by the component are stored in a DataStore
 * 
 * This DataStore is using a hashmap.
 *
 */
class MapData extends Base implements DataStore
{
    private $store=[];
    private $parent;
    
    /**
     * Initialize 
     * @param DataStore $p_parent Parent DataStore
     * @param array $p_data     This store is filled with this data.
     */
    function __construct(?DataStore $p_parent,Array $p_data=[])
    {
        $this->parent=$p_parent;    
        $this->store=$p_data;
    }
    
    /**
     * Get Parent data store     
     * 
     * @see \XMLView\Engine\Data\DataStore::getParent()
     */
    function getParent():?DataStore
    {
        return $this->parent;
    }
    
    /**
     * Get the value from the store.
     * First the value is looked up in this store, when not found
     * the parent store is queries.
     * When data is not found, a @see DataNotFoundException is raised 
     *
     */
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
    
    /** 
     * Sets value in this store. 
     * When a value exists in this store, the value is written.
     * When value exists in a parent store, the value is not overwritten but
     * added to this store    
     */
    function setValue(string $p_name,$p_value):void
    {
        $this->store[$p_name]=$p_value;
    }
    
    /**
     * Set values by associative array. The key is the name of the value 
     */
    function setValues(Array $p_values):void
    {
        $this->store=array_merge($this->store,$p_value);
    }
}
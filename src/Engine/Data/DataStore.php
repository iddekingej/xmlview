<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

/**
 *  Data used in the xmlviews are stored in the datastore
 *
 */
interface DataStore
{
    /**
     * Parent data store
     * 
     * @return DataStore
     */
    function getParent():DataStore;
    /**
     * Get value from data store
     * When data doesn't exists a DataNotFoundException  is raised     
     * When data is not in this store , the parent store is queries.
     * 
     * @param string $p_name Name of the data
     */
    function getValue(string $p_name);
    
    /**
     * Saves data. If the value exists in this store, the value is overwritten.
     * When the value is in a parent store, a new  value in added in this store.
     *  
     * @param string $p_name     Name
     * @param unknown $p_value
     */
    function setValue(string $p_name,$p_value):void;
    
    /**
     * Set values in this store.
     * 
     * @param array $p_values Associative array with values.
     */
    function setValues(Array $p_values):void;

}
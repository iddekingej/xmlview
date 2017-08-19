<?php 
declare(strict_types=1);
namespace XMLView\Base;


/**
 * Base objects for all other object
 * Contains __SET and __GET to protect for setting and getting non existing properties
 *
 */
class Base
{
    /**
     * This method protects  an object for writing a property that doesn't 
     * exists
     * 
     * @param string $p_name        Name of variable
     * @param unknown $p_value      
     * @throws UnknownPropertyException   Raised when property p_name doesn't exists
     */
    final function __SET($p_name,$p_value)
    {
        throw new UnknownPropertyException($this, $p_name);
    }
    
    /**
     * This method protects an object for reading a property that doesn't exists
     * 
     * @param unknown $p_name              Attempt to read a property with this name
     * @throws UnknownPropertyException    Raised when property $p_name doesn't exists
     */
    final function __GET($p_name){
        throw new UnknownPropertyException($this,$p_name);
    }
}
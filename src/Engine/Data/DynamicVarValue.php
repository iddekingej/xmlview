<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;
/**
 * Most component properties are DynamicValue object because they can be dynamic
 * (contain variables).
 * 
 * DynamicVarValue is used when the property is a variable
 *
 */

class DynamicVarValue implements DynamicValue
{
    /**
     * Variable that is wrapped in a DynamicValue
     * 
     * @var string
     */
    private $var;
    
    function __construct(string $p_var)
    {
        $this->var=$p_var;
    }
    
    /**
     * Returns the value of the DynamicVarValue, that is the 
     * value of the variable retrieved from the datasource.
     * 
     */
    function getValue(DataStore $p_dataStore)
    {
        return $p_dataStore->getValue($this->var);
    }
}
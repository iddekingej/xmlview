<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;
/**
 * Most component properties are DynamicValue object because they can be dynamic
 * (contain variables).
 * DynamicStaticValue class is used when the property has a static value.
 *
 */
class DynamicStaticValue implements DynamicValue
{
    /**
     * Static value
     * @var unknown
     */
    private $value;
    
    /**
     * Initialize the object
     * 
     * @param unknown $p_value Value to wrap in a DynamicValue object
     */
    function __construct($p_value)
    {
        $this->value=$p_value;
    }
    
    /**
     * Get the value. Because the value is static, the value doesn't depend 
     * on the DataStore.
     */
    function getValue(DataStore $p_store)
    {
        return $this->value;
    }
    
    /**
     * Get the static value. (Same as getValue, but this method doesn't
     * need a DataStore object)
     * @return \XMLView\Engine\Data\unknown
     */
    function getStaticValue()
    {
        return $this->value;
    }
}
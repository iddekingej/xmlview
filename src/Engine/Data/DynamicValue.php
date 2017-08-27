<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

/**
 * Because component properties can be dynamic (for example contain variables)
 * the property definition is wrapped in a object.
 * The wrap must implement the DynamicValue interface. 
 * Currently the following objects are available:
 * -DynamicStaticValue       Value is static
 * -DynamicVarValue          Value is a variable (retrieved from DataStore)
 * -DynamicSequenceValue     A sequence of static and variables
 * -DynamicTranslationValue  Value is a string that must be translated and can have parameters
 */

interface DynamicValue
{
    /**
     * When a value is requested this method must be used.
     * 
     * @param DataStore $p_dataStore Data used for calculating the 
     */
    function getValue(DataStore $p_dataStore);
}
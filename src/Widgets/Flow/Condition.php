<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Flow;

use XMLView\Engine\Data\DynamicValue;
use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;
use XMLView\Base\SubList;

/**
 * When conditionValue==true: HTML is generated from the sub elements 
 *                      false: No html or js is generated.
 */
class Condition extends FlowWidget{
   
    private $conditionValue;
    
    /**
     * Get all JS url's used by all it's child widgets 
     */
    function getJs(DataStore $p_store):array
    {
        if($this->conditionValue){
            return $this->getJsTrait($p_store);
        }
        return [];
    }
    
    /**
     * Get all the CSS that is used by all it's child widgets
     */
    function getCss(DataStore $p_store):array
    {
        if($this->conditionValue){
            return $this->getCssTrait($p_store);
        }
        return [];
    }
    
    /**
     * Set the condition value 
     * @param DynamicValue $p_conditionValue Wraps a true value -childeren are displayed false- childer are not displayed
     */
    function setConditionValue(DynamicValue $p_conditionValue):void
    {
        $this->conditionValue=$p_conditionValue;
    }
    
    function getConditioNValue():?DynamicValue
    {
        return $this->conditionValue;
    }
    
    function displayContent(DataStore $p_store):void
    {
        $l_conditionValue=$this->getAttValue("conditionValue", $p_store,"boolean",true);
        if($l_conditionValue){
            foreach($this->subItems as $l_item){
                $l_item->display($p_store);
            }
        }
    }
}
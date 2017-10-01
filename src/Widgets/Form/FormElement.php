<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;

abstract class FormElement extends Widget
{
    private $id;
    private $rowId;
    private $value;
    private $label;
    private $error="";
    private $condition;
    private $elementName;
    
    function setError(string $p_error):void
    {
        $this->error=$p_error;
    }
    
    function getError():string
    {
        return $this->error;
    }
    
    function setRowId(string $p_rowId):void
    {
        $this->rowId=$p_rowId;
    }
    
    function getRowId():?string
    {
        return $this->rowId;
    }
    
    function setId(string $p_id):void
    {
        $this->id=$p_id;
    }
    
    function getId():?string
    {
        return $this->id;
    }
    
    function setValue(DynamicValue $p_value):void
    {
        $this->value=$p_value;
    }
    
    function getValue():?DynamicValue
    {
        return $this->value;
    }
    
    function getRealValue(DataStore $p_store)
    {
        $l_name=$this->getName();
        return $p_store->getValue($l_name);        
    }
    
    function setLabel(DynamicValue$p_label):void
    {
        $this->label=$p_label;
    }
    
    function getLabel():DynamicValue
    {
        return $this->label;
    }
    
    function setCondition(DynamicValue $p_condition):void
    {
        $this->condition=$p_condition;
    }
    
    function hasData()
    {
        return false;
    }
    
    function getCondition()
    {
        return $this->condition;
    }
    function setElementName(DynamicValue $p_elementName):void
    {
        $this->elementName=$p_elementName;
    }
    function getElementName():?DynamicValue
    {
        return $this->elementName;
    }
    
    function getRealElementName(DataStore $p_store)
    {
        if($this->elementName!== NULL){
            return $this->getAttValue("elementname",$p_store,"string",true);
        }
        return $this->getName();
    }

}
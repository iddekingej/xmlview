<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;

abstract class InfoTableItem extends Widget
{
    private $label;
    
    function setLabel(DynamicValue $p_label):void
    {
        $this->label=$p_label;
    }
    
    function getLabel():?DynamicValue
    {
        return $this->label;
    }
    
    abstract function displayValue(DataStore $p_store):void;
    
    function displayContent(?DataStore $p_store)
    {
        $l_label=$this->getAttValue("label", $p_store,"string",true);
        $this->theme->base_InfoTable->ItemHeader($l_label);
        $this->displayValue($p_store);
        $this->theme->base_InfoTable->itemFooter();
    }
}
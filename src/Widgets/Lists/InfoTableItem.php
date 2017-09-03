<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;

/**
 * This is a abstract used for items in a InfoTable.
 * This component outputs a table row with 2 cells. 
 * The left cell contains a label. 
 * The contents of the right value must be set in the methon displayValue
 */
abstract class InfoTableItem extends Widget
{
    private $label;
    
    /**
     * Set the label value in the left cell
     * 
     * @param DynamicValue $p_label Label text wrapped in a DynamicValue. This is mandatory and should be a string 
     */
    function setLabel(DynamicValue $p_label):void
    {
        $this->label=$p_label;
    }
    /**
     * Get the label displayed on the left.
     * @return DynamicValue|NULL  Display label.
     */
    function getLabel():?DynamicValue
    {
        return $this->label;
    }
    
    /**
     * Display the content of the value cell here.
     * @param DataStore $p_store Data used for displaying the information
     */
    abstract function displayValue(DataStore $p_store):void;
    
    function displayContent(DataStore $p_store):void
    {
        $l_label=$this->getAttValue("label", $p_store,"string",true);
        $this->theme->base_InfoTable->ItemHeader($l_label);
        $this->displayValue($p_store);
        $this->theme->base_InfoTable->itemFooter();
    }
}
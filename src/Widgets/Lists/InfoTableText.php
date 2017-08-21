<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;
use XMLView\Theme;

/**
 * This component is one row in the InfoTable component
 * 
 * The value of the right is just a static text. The text is hmtl escaped.
 *
 */
class InfoTableText extends InfoTableItem
{
    /**
     * Text displayed on the right wrapped in a DynamicValue object
     * 
     * @var DynamicValue
     */
    private $text;
    
    /**
     * Set the text displayed in the right cell
     * 
     * @param DynamicValue $p_text This should be a value wrapped in a DynamicValue object
     */
    
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    /**
     * Get The displayed text on the right.
     * 
     * @return DynamicValue|NULL
     */
    function getText():?DynamicValue
    {
        return $this->text;
    }
    
    function displayValue(DataStore $p_store):void
    {
        $l_text=$this->getAttValue("text", $p_store);
        echo $this->theme->e($l_text);
    }
}
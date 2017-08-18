<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;
use XMLView\Theme;

class InfoTableText extends InfoTableItem
{
    private $text;
    
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
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
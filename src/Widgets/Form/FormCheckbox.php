<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DataStore;

class FormCheckbox extends FormInputElement
{
    function displayElement(?DataStore $p_store=null):void
    {        
        $this->theme->base_Form->checkboxElement($this->getId(),$this->getName(),$this->getValue()->getValue(p_store));        
    }
}
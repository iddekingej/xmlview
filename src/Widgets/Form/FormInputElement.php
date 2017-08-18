<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DataStore;

abstract class FormInputElement extends FormElement
{
    abstract function displayElement(DataStore $p_store=null);
    
    function hasData()
    {
        return true;
    }
    
    final function displayContent(?DataStore $p_store=null)
    {
        $this->theme->base_Form->rowHeader($this->getName(),$this->getLabel()->getValue($p_store),$this->getError(),$this->getRowId());
        $this->theme->base_Form->elementHeader();
        $this->displayElement($p_store);
        $this->theme->base_Form->rowFooter();
    }
}
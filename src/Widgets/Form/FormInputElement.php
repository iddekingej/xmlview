<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DataStore;

/**
 * Base class for all form elements that can have a input value
 *
 */
abstract class FormInputElement extends FormElement
{
    /**
     * FormInputElement displays the element header,label and footer.
     * A form element widget should override displayElement to display the input widget
     *  
     * @param DataStore $p_store  Data used for calculating the value of the input element
     */
    abstract function displayElement(DataStore $p_store=null);
    
/**
 * Indicates that element has a value
 * 
 */    
    function hasData()
    {
        return true;
    }
    
    /**
     * Displays the row header on the left, a label.
     * DisplayElement should display the input element it self  
     */
    
    final function displayContent(?DataStore $p_store=null)
    {
        $this->theme->base_Form->rowHeader($this->getName(),$this->getLabel()->getValue($p_store),$this->getError(),$this->getRowId());
        $this->theme->base_Form->elementHeader();
        $this->displayElement($p_store);
        $this->theme->base_Form->rowFooter();
    }
}
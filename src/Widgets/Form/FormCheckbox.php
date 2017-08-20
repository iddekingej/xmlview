<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DataStore;

/**
 * This widget displays a checkbox
 *
 */
class FormCheckbox extends FormInputElement
{
    /**
     * Generates the HTML for the checkboxex
     * @param p_store Data store used for calculating the value expression
     *                When value is true, a checkbox is displayed 
     */
    function displayElement(?DataStore $p_store=null):void
    {        
        $this->theme->base_Form->checkboxElement($this->getId(),$this->getName(),$this->getValue()->getValue(p_store));        
    }
}
<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DataStore;

/**
 * Displays a  single line text input element
 *
 */
class FormText extends FormInputElement
{
    function displayElement(?DataStore $p_store=null):void
    {
        $this->theme->base_Form->textElement($this->getId(),$this->getName(),$this->getRealValue($p_store));
    }
}
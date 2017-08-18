<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DataStore;

/**
 * Class for password input element
 *
 */

class FormPassword extends FormInputElement
{

    /**
     * Displays a password input element
     */
    
    function displayElement(?DataStore $p_store=null):void
    {
        $this->theme->base_Form->password($this->getId(),$this->getName(),$this->getReadValue($p_store));        
    }
}
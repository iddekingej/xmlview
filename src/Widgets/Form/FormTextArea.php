<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Engine\Data\DataStore;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DynamicStaticValue;

/**
 * Class representing a Textarea form element 
 * 
 */

class FormTextArea extends FormInputElement
{
    /**
     * Width of the textarea in css units
     * @var DynamicValue
     */
    private $width;
    /**
     * Height of the textarea in css units
     * 
     * @var DynamicValue
     */
    private $height;
    
    function __construct()
    {
        parent::__construct();
        $this->width=new DynamicStaticValue("100%");
        $this->height=new DynamicStaticValue("100px");
    }
    /**
     * Set the width of the text area.
     * 
     * @param string $p_width Width of the text area in pixels.
     */
    
    function setWidth(DynamicValue $p_width):void
    {
        $this->width=$p_width;
    }
    
    /**
     * Get the width of the text area
     * 
     * @return string Width of the textarea in pixels.
     */
    function getWidth():DynamicValue
    {
        return $this->width;
    }
    
    /**
     * Set the height of the text area
     * 
     * @param string $p_height height of the text area in pixels. 
     */
    
    function setHeight(DynamicValue$p_height):void
    {
        $this->height=$p_height;
    }
    /**
     * Get the height of the text area 
     * 
     * @return string Height of the text area in pixels
     */
    function getHeight():DynamicValue
    {
        return $this->height;
    }
    
    /**
     * Display a textarea element
     * 
     * @see \App\Vc\Form\FormInputElement::displayElement()
     */
    function displayElement(DataStore $p_store):void
    {
        $l_css  ="width:".$this->width->getValue($p_store).";";
        $l_css .="height:".$this->height->getValue($p_store);
        $this->theme->base_Form->textAreaElement($this->getId(),$this->getName(),$this->getRealValue($p_store),$l_css);
    }
}
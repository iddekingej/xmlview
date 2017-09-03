<?php
declare(strict_types=1);
namespace XMLView\Widgets\Text;

use XMLView\Engine\Data\DataStore;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicStaticValue;

/**
 * Displays a static text
 * When class is set, it is displayed in a span element
 *
 */
class StaticText extends Widget
{
    /**
     * Static text displayed on the page
     * @var string
     */
    
    private $text;
    
    /**
     * CSS class used for the text. When this is set , the text
     * is displayed in a span element.
     * Default value: empty
     * 
     * @var string
     */
    
    private $class;

    /**
     * Set up object
     * 
     * @param string $p_text    Text displayed as static text. 
     *                          The text is html escaped before it is displayed.
     * @param string $p_class   CSS Class used for displaying the text.(Default no class)
    */

    function __construct()
    {
        $this->setContainerHeight(new DynamicStaticValue(""));
        $this->setContainerWidth(new DynamicStaticValue(""));
        parent::__construct();
    }
    
    
    /**
     * Set the static text displayed on the page
     * 
     * @param string $p_text  Static text, doesn't need to be html escaped.
     */
    
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    /**
     * Get the static text.
     * 
     * @return string|NULL
     */
    function getText():?DynamicValue
    {
        return $this->text;
    }
    /**
     * Set the CSS class for displaying the text.
     * 
     * @param string $p_class CSS class
     */
    function setClass(DynamicValue $p_class):void
    {
        $this->class=$p_class;
    }
    
    /**
     * Get the CSS class used for displaying the text
     * @return string|NULL CSS class
     */
    
    function getClass():?DynamicValue
    {
        return $this->class;
    }
    
    /**
     * Output the text
     * The text is html escaped before displaying it.  
     * When the class is set, the text is placed in a span element and the css class
     * of the span is set.
     */
    
    function displayContent(DataStore $p_store):void
    {
        if($this->text){
            $l_text=$this->getAttValue("text",$p_store);
            $l_class=$this->getAttValue("class",$p_store,"string");
            if($this->class){
                ?><span class="<?=$l_class?>"><?=$this->theme->e($l_text)?></span><?php 
            } else {
                echo $this->theme->e($l_text);
            }
        }
            
    }
}
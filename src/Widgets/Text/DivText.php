<?php
declare(strict_types=1);
namespace XMLView\Widgets\Text;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;

class DivText extends Widget
{
    private $text;
    
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
    
    function displayContent(DataStore $p_store)
    {
        $l_text=$this->getAttValue("text",$p_store,"string","true");
        $this->theme->base_Text->divText($this->getBlockClass($p_store),$l_text);
    }
}
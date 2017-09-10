<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Text;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;
use XMLView\Engine\Data\DynamicValue;
/**
 * Displays a note message
 *
 */
class Note extends Widget{
    
    /**
     * Text displayed in the note.
     * 
     * @var DynamicValue|null
     */
    private $text;
    

    /**
     * Set the text of the node 
     * @param DynamicValue $p_text   
     */
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    /**
     * Get the text of the note
     * 
     * @return DynamicValue
     */
    function getText():?DynamicValue
    {
        return $this->text;
    }
    
    /**
     * Displayes the note
     * 
     * @param DataStore $p_store Data used for displaying the note messsage
     */
    
    function displayContent(DataStore $p_store):void
    {
        if($this->text != null){
            $this->theme->page_Page->note($this->text->getValue($p_store));
        }
    }
}
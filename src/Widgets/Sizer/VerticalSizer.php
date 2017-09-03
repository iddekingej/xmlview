<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Sizer;

use XMLView\Engine\Data\DataStore;

/**
 * Places all elements vertical
 *
 */
class VerticalSizer extends Sizer
{
/**
 * Displays all sub-elements vertical 
 * 
 * @param DataStore p_store  Data used for displaying the elements
 */
    function displayContent(?DataStore $p_store):void
    {
        $this->theme->base_Sizer->sizerHeader();
        foreach($this->subItems as $l_item){
            $this->theme->base_Sizer->rowHeader();            
            $this->displayItem($l_item, $p_store);
            $this->theme->base_Sizer->rowFooter();
        }        
        $this->theme->base_Sizer->sizerFooter();
    }
}
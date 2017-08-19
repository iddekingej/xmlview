<?php 

namespace XMLView\Widgets\Base;

use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;
use XMLView\Widgets\Sizer\VerticalSizer;
use XMLView\Base\SubSizer;


/**
 * Top container used for XML Resources
 *
 */
class GUIFragment extends Widget{
    
    use SubSizer;
    
   
    /**
     * Set up default size of all sub widget
     */
    function __construct()
    {
        parent::__construct();
        $this->top=new VerticalSizer();
    }
    
    
    /**
     * Display all content 
     */
    function displayContent(?DataStore $p_store=null)
    {
        $this->top->display($p_store);
    }
}
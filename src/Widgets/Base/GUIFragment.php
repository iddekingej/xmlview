<?php 

namespace XMLView\Widgets\Base;

use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;
use XMLView\Widgets\Sizer\VerticalSizer;


/**
 * Top container used for XML Resources
 *
 */
class GUIFragment extends Widget{
    
    private $top;
    
    /**
     * Set up default size of all sub widget
     */
    function __construct()
    {
        parent::__construct();
        $this->top=new VerticalSizer();
    }
    
    /**
     * Add child widget
     *      
     * @return \XMLView\HtmlComponent child widge
     */
    function add(HtmlComponent $p_child){
        $this->top->add($p_child);
        $p_child->setParent($this);
        return $p_child;
    }
    
    /**
     * Display all content 
     */
    function displayContent(?DataStore $p_store=null)
    {
        $this->top->display($p_store);
    }
}
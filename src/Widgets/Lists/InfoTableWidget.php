<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;


use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Sizer\HorizontalSizer;
use XMLView\Base\SubSizer;

/**
 * An InfoTable item. 
 * Left a static text is displayed an right there is a widget displayed 
 *
 */
class InfoTableWidget extends InfoTableItem{
    use SubSizer;
    
    
    /**
     * Setup the widget.
     * Create a sizer used for a container for the widget on the right side.
     */
    function  __construct()
    {
        parent::__construct();
        $this->setTop(new HorizontalSizer());
    }
    
    /**
     * Set the widget displayed on the right
     * @param Widget $p_widget Widget to display
     */
    function setWidget(Widget $p_widget):void
    {
        $this->widget=$p_widget;
    }
    
    /**
     * Get the widget displayed on the right
     * @return Widget|NULL
     */
    function getWidget():?Widget
    {
        return $this->widget;
    }
    
    /**
     * Display Widget on the right
     * @param DataStore $p_store Data used for displaying the widget
     */
    function displayValue(DataStore $p_store):void
    {
        $this->top->display($p_store);
    }
    

}
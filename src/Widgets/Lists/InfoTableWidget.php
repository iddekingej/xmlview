<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;


use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Sizer\HorizontalSizer;

/**
 * An InfoTable item. 
 * Left a static text is displayed an right there is a widget displayed 
 *
 */
class InfoTableWidget extends InfoTableItem{
    
    /**
     * Widget on the right size are added to this sizer
     * 
     * @var HorizontalSizer
     */
    private $top;
    
    
    /**
     * Setup the widget.
     * Create a sizer used for a container for the widget on the right side.
     */
    function  __construct()
    {
        parent::__construct();
        $this->top=new HorizontalSizer();
    }
    
    /**
     * Add a value widget.
     * 
     * @param Widget $p_widget This widget is added to a horizontal sizer 
     */
    function add(Widget $p_widget)
    {
        $this->top->add($p_widget);
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
    
    /**
     * Get the JS files used  in this widget.
     * @return array List of JS files used by this widget
     */
    function getJs():array
    {
        return $this->top->getJs();
    }
    
    /**
     * CSS files used by this widget
     * @return array  Array of CSS files used by this widget. 
     */
    
    function getCss():array
    {
        return $this->top->getCss();
    }
}
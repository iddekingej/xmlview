<?php 
declare(strict_types=1);
namespace XMLView\Base;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;

/**
 * This is a trait for widget to contain one sub element.
 * This sub element is a sizer that can contain one or more children.
 *
 */
trait SubSizer
{
    private $top;
    
    function setTop(Widget $p_widget){
        $this->top=$p_widget;
        $this->top->setParent($this);
    }
    /**
     * Get JS url's for this widget
     *      
     * @param DataStore $p_store   Data used in component
     * @return array               Returns array list with js url's
     */
    function getMyJs(DataStore $p_store):array
    {
        return [];
    }
    
    /** 
     * Get CSS url's for this widget
     * @param DataStore $p_store
     * @return array                Return array list with css url's
     */
    function getMyCss(DataStore $p_store):array
    {
        return [];
    }
    
    /**
     * Get all Js url's used by this component and its child elements
     * @param DataStore $p_store    Data used by this component
     * @return array                List of js url's
     */
    function getJs(DataStore $p_store):array
    {
        return array_merge($this->getMyJs($p_store),$this->top->getJs($p_store));
    }
    
    /**
     * Get all css url's u sed by this component and its child elements.
     * 
     * @param DataStore $p_store     Data used by this component
     * @return array                 List of css url's
     */
    
    function getCss(DataStore $p_store):array
    {
        return array_merge($this->getMyCss($p_store),$this->top->getCss($p_store));
    }
    
    /**
     * Add a child widget 
     * 
     * @param Widget $p_widget        Child widget
     */
    function add(Widget $p_widget)
    {
        $this->top->add($p_widget);
        $p_widget->setParent($this);
    }
    
    /**
     * Get top widget
     * 
     * @return Widget|NULL
     */
    function getTop():?Widget
    {
        return $this->top;
    }
}
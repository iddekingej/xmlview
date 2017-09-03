<?php 
declare(strict_types=1);
namespace XMLView\Base;

use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;

/**
 * Trait used for elements with one or more sub items
 */

trait SubList{
    protected $subItems=[];
    
    /**
     * When a child widget is added to this component the element is checked 
     * in this method
     *  
     * @param HtmlComponent $p_compontent Check this widget
     */
    protected function validateSubItem(HtmlComponent $p_compontent)
    {
        
    }
    
    /**
     * Get JS files used by this component
     * 
     * @param DataStore $p_store  Data store used for calculating condition.
     * @return array              Javascript used by this component
     */
    function getMyJs(DataStore $p_store):array
    {
        return [];
    }

    /**
     * Get css files used by this component
     *
     * @param DataStore $p_store  Data store used for calculating condition.
     * @return array              CSS used by this component
     */
    function getMyCss(DataStore $p_store):array
    {
        return [];
    }
    
/**
 * Collect Java script files used by this component and sub elements
 * These java script are included in the header of the page 
 * 
 * @return array List of Javascript files
 */
    function getJs(DataStore $p_store):array
    {
        $l_js=$this->getMyJs($p_store);
        foreach($this->subItems as $l_item){
            if($l_item->evaluateVisibility($p_store)){
                $l_js=array_merge($l_js,$l_item->getJs($p_store));
            }
        }
        return array_unique($l_js);
    }
    
/**
 * Collect Css files used by used by this component and  sub elements
 * The returned CSS files are included in the header of the page.
 * 
 * @return array Used css files
 */
    function getCss(DataStore $p_store):array
    {
        $l_css=$this->getMyCss($p_store);
        foreach($this->subItems as $l_item){
            if($l_item->evaluateVisibility($p_store)){
                $l_css=array_merge($l_css,$l_item->getCss($p_store));
            }
        }
        return array_unique($l_css);
    }
/**
 * Get the sub elements.
 * 
 * @return Array  An list of HtmlComponent objects that are sub elements
 */
    function getSubItems():array
    {
        return $this->subItems;
    }
    
/**
 * Add a component to the sublist , also the parent property is set by this method.
 * 
 * @param HtmlComponent $p_component HtmlComponent to be added as subitem
 * @return \App\Vc\Lib\HtmlComponent Is the same as $p_component
 */    
    function add(HtmlComponent $p_component):HtmlComponent
    {
        
        $this->validateSubItem($p_component);
        $this->subItems[]=$p_component;
        $p_component->setParent($this);
        return $p_component;
    }
    

    function preDisplaySub(DataStore $p_store,Widget $p_item):void
    {
        
    }
    
    function postDisplaySub(DataStore $p_store,Widget $p_item):void
    {
        
    }
    
    /**
     * Print sub elements of this component:
     * Only components that a visible are displayed.
     * @param DataStore $p_store
     */
    
    function displaySub(DataStore $p_store):void
    {
        foreach($this->subItems as $l_item){
            if($l_item->evaluateVisibility($p_store)){
                $this->preDisplaySub($p_store,$l_item);
                $l_item->display($p_store);
                $this->postDisplaySub($p_store,$l_item);
            }
        }
    }
}
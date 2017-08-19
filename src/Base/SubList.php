<?php 
declare(strict_types=1);
namespace XMLView\Base;

use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Engine\Data\DataStore;

/**
 * Trait used for elements with sub items
 */

trait SubList{
    protected $subItems=[];
    
    /**
     * Function used for checking the widget when added to the parent
     *  
     * @param HtmlComponent $p_compontent Check this widget
     */
    protected function validateSubItem(HtmlComponent $p_compontent)
    {
        
    }
    
    function getMyJs(DataStore $p_store):array
    {
        return [];
    }
    
    function getMyCss(DataStore $p_store):array
    {
        return [];
    }
    
/**
 * Collect Java script files used by subelements
 * These java script are included in the header of the page 
 * 
 * @return array List of javascript files
 */
    function getJs(DataStore $p_store):array
    {
        $l_js=$this->getMyJs($p_store);
        foreach($this->subItems as $l_item){
            $l_js=array_merge($l_js,$l_item->getJs($p_store));
        }
        return array_unique($l_js);
    }
    
/**
 * Collect Css files used by used by the sub element
 * The returned CSS files are included in the header of the page.
 * 
 * @return array Used css files
 */
    function getCss(DataStore $p_store):array
    {
        $l_css=$this->getMyCss($p_store);
        foreach($this->subItems as $l_item){
            $l_css=array_merge($l_css,$l_item->getCss($p_store));
        }
        return array_unique($l_css);
    }
/**
 * Get the sub element.
 * 
 * @return Array  An list of HtmlComponent objects that are subelements
 */
    function getSubItems()
    {
        return $this->subItems;
    }
    
/**
 * Add a component to the sublist , also the parent property is set by this method.
 * 
 * @param HtmlComponent $p_component HtmlComponent to be added as subitem
 * @return \App\Vc\Lib\HtmlComponent Is the same as $p_component
 */    
    function add(HtmlComponent $p_component){
        
        $this->validateSubItem($p_component);
        $this->subItems[]=$p_component;
        $p_component->setParent($this);
        return $p_component;
    }
}
<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;


use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;

/**
 * MenuItem for LeftMenu
 * This menu item is displayed as a text link.
 *
 */
class TextMenuItem extends MenuItem
{
    /**
     * Text displayed in menu item
     * @var unknown
     */
    private $text;
    private $route;
    private $params;
    
    /**
     * Set the text displayed in the menu item
     * @param DynamicValue $p_text The menu text, a string wrapped in a @see DynamicValue
     */
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    /**
     * Get the text displayed in the menu 
     * @return DynamicValue|NULL
     */
    function getText():?DynamicValue
    {
        return $this->text;
    }

    /**
     * The route name used in the target URl of the menu item
     * @param DynamicValue $p_route
     */
    function setRoute(DynamicValue $p_route):void
    {
        $this->route=$p_route;
    }
    
    /**
     * Get the the route name used in the target URl of the menu item
     * The route url is Route(route,params)
     * 
     * @return DynamicValue|NULL
     */
    function getRoute():?DynamicValue
    {
        return $this->route;
    }
    
    /**
     * The parameters of in the target URl of the menu item
     * @param DynamicValue $p_route
     */
    
    function setParams(DynamicValue $p_params):void
    {
        $this->params=$p_params;
    }
    
    /**
     * Get the parameters of in the target URl of the menu item

     * @return DynamicValue|NULL
     */
    function getParams():?DynamicValue
    {
        return $this->params;
    }

    /**
     * Print the menu item
     * 
     * The menu item is basically a text link 
     */
    function displayContent(DataStore $p_store):void
    {
        $l_route=$this->getAttValue("route", $p_store,"string",true);
        $l_params=$this->getAttValue("params", $p_store,"array",false);
        $l_text=$this->getAttValue("text", $p_store,"string",true);
        if($l_params===null){
            $l_params=[];
        }
        $this->theme->menu_LeftMenu->menuItem($l_route,$l_params,$l_text);
    }
}
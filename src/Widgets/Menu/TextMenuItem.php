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
    
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    function getText():?DynamicValue
    {
        return $this->text;
    }
    
    function setRoute(DynamicValue $p_route):void
    {
        $this->route=$p_route;
    }
    
    function getRoute():?DynamicValue
    {
        return $this->route;
    }
    
    
    function setParams(DynamicValue $p_params):void
    {
        $this->params=$p_params;
    }
    
    function getParams():?DynamicValue
    {
        return $this->params;
    }
    
    function displayContent(DataStore $p_store):void
    {
        $l_route=$this->getAttValue("route", $p_store,"string",true);
        $l_params=$this->getAttValue("params", $p_store,"array",false);
        $l_text=$this->getAttValue("text", $p_store,"string",true);
        if($l_params===null){
            $l_params=[];
        }
;        $this->theme->menu_LeftMenu->menuItem($l_route,$l_params,$l_text);
    }
}
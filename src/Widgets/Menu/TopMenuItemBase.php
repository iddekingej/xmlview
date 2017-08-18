<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;

class TopMenuItemBase extends Widget{
    /**
     * Menu text displayed
     * @var DynamicValue
     */
    private $text;
    
    /**
     * Route used in url when clicking the menu item
     * @var DynamicValue
     */
    private $route;
    
    /**
     * Parameters used in the url when clicking the menu item (can be empty)
     * @var DynamicValue
     */
    private $params;
    
    /**
     * @var DynamicValue
     */
    private $icon;
    
    /**
     * Set the text displayed in menu
     *
     * @param DynamicValue $p_text
     */
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    /**
     * Get the text displayed in the menu item
     *
     * @return DynamicValue|NULL
     */
    function getText():?DynamicValue
    {
        return $this->text;
    }
    
    /**
     * Set the route url used when clicking the menu item
     *
     * @param DynamicValue $p_route
     */
    function setRoute(DynamicValue $p_route):void
    {
        $this->route=$p_route;
    }
    
    /**
     * Set the parameters used in the URL when the menu item is selected
     * 
     * @param DynamicValue $p_params Parameters for the URL. The encapsulated value should be a array.
     */
    function setParams(DynamicValue $p_params):void
    {
        $this->params=$p_params;
    }
    
    function getParams():?DynamicValue
    {
        return $this->params;
    }
    
    /**
     * Get the route of the url used when the menu is selected.
     *
     * @return DynamicValue|NULL
     */
    function getRoute():?DynamicValue
    {
        return $this->route;
    }
    
    /**
     * Get the icon displayed on the front of the menu item. When empty, no icon
     * is displayed
     *
     * @param DynamicValue $p_icon
     */
    function setIcon(DynamicValue $p_icon):void
    {
        $this->icon=$p_icon;
    }
    
    /**
     * Get the icon displayed at the fron of the menu item.
     * When this value is null or getValue returns a empty string, no icon is displayed.
     *
     * @return DynamicValue|NULL
     */
    function getIcon():?DynamicValue
    {
        return $this->icon;
    }
}
<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;

abstract class TopMenuItemBase extends Widget{
    /**
     * Menu text displayed
     * @var DynamicValue
     */
    private $text;
    
    /**
     * URL of link used in menu item
     *
     * @var DynamicValue   Url string wrapped in  a DynamicValue object
     */
    private $url;
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
     * Set the menu URL .
     * This parameter is mandatory
     *
     * @param DynamicValue $p_url URL string wrapped in a DynamicObject
     */
    function setUrl(DynamicValue $p_url):void
    {
        $this->url=$p_url;
    }
    
    /**
     * Get the menu Url
     *
     * @return DynamicValue|NULL Menu URL wrappedi n a DynamicObject
     */
    function getUrl():?DynamicValue
    {
        return $this->url;
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
     * Get the icon displayed at the front of the menu item.
     * When this value is null or getValue returns a empty string, no icon is displayed.
     *
     * @return DynamicValue|NULL
     */
    function getIcon():?DynamicValue
    {
        return $this->icon;
    }
}
<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;
/**
 * A item from the Tab menu
 * A tab menu is a menu with items that looks like a tab
 *
 */
class TabMenuItem extends Widget
{
    /**
     * Text displayed in the menu
     * @var DynamicValue
     */
    private $text;
    
    /**
     * The url of the menu
     * @var DynamicValue
     */
    private $url;
    /**
     * Unique ID of the menu item. This is used to determine which 
     * menu item is selected
     * 
     * @var DynamicValue
     */
    private $tag;
    
    /**
     * The unique ID of the menu
     * 
     * @param DynamicValue $p_tag  The unique ID. A string wrapped in a DynamicValue
     */
    
    function setTag(DynamicValue $p_tag):void
    {
        $this->tag=$p_tag;
    }
    
    /**
     * Get the current ID of this menu item
     * @return DynamicValue|NULL  The unique ID. A string wrapped in a DynamicValue
     */
    function getTag():?DynamicValue
    {
        return $this->tag;
    }
    
    /**
     * Set the menu item text
     * 
     * @param DynamicValue $p_text Menu text. A string wrapped in a DynamicValue
     */
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    /**
     * Get the text displayed in the menu
     * 
     * @return DynamicValue The menu text wrapped in a DynamicValue
     */
    function getText():DynamicValue
    {
        return $this->text;
    }
    
    /**
     * Set the menu URL
     * 
     * @param DynamicValue $p_url URL String wrapped in DynamicValue
     */
    function setUrl(DynamicValue $p_url):void
    {
        $this->url=$p_url;
    }
    
    /**
     * 
     * @return DynamicValue
     */
    function getUrl():DynamicValue
    {
        return $this->url;
    }
    
    /**
     * Display the menu item
     * @param DataStore $p_store Data used for displaying the menu
     */
    function displayContent(DataStore $p_store):void
    {
        $l_tag=$this->getParent()->getAttValue("currentTag",$p_store,"string",false);
        $l_current=$this->getAttValue("tag",$p_store,"string",false);
        $l_url=$this->getAttValue("url",$p_store,"string",true);
        $l_text=$this->getAttValue("text",$p_store,"string",true);
        if($l_tag==$l_current){
            $this->theme->menu_TabMenu->menuItemSelected($l_url,$l_text);
        } else {
            $this->theme->menu_TabMenu->menuItem($l_url,$l_text);
        }
    }    
   
}
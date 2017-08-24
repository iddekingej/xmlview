<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Widgets\Base\WrongWidgetTypeException;
use XMLView\Engine\Data\DataStore;
use XMLView\Base\SubList;

/**
 *  Group of menu items used in LeftMenu
 *  Groups are added to the LeftMenu
 *  Items are added to the MenuGroup 
 */
class MenuGroup extends Widget
{
    use SubList;
    /**
     * Menu group title displayed in the menu
     * @var string
     */
    private $title;
    
    /**
     * Set the MenuGroup title (Title displayed in the menu)
     * @param DynamicValue $p_title
     */
    function setTitle(DynamicValue $p_title):void
    {
        $this->title=$p_title;
    }
    
    /**
     * Get the menu title
     * 
     * @return DynamicValue|NULL
     */
    
    function getTitle():?DynamicValue
    {
        return $this->title;
    }
    
    /**
     * Get the menu object to which the menu group belongs
     * 
     * @return LeftMenu
     */
    function getMenu():LeftMenu
    {
        return $this->getParent();
    }
    
    /**
     * Add menu item to group
     * 
     * @param MenuItem $p_item
     */
    function addItem(MenuItem $p_item):void
    {
        $this->subItems[]=$p_item;
    }
    
    /**
     * Get the current tag of the menu to which the group belongs.
     * (Which menu is selected?)
     * 
     * @return DynamicValue|NULL
     */
    function getCurrentTag():?DynamicValue
    {
        $l_menu=$this->getMenu();
        if($l_menu){
            return $l_menu->getCurrentTag();
        }
        return null;
    }
    
    /**
     * Add a text menu item to group 
     * 
     * @param unknown $p_tag Unique ID for the menu item 
     * @param unknown $p_text  Menu item title
     * @param unknown $p_route Route of menu item
     */
    function addTextItem($p_tag,$p_text,$p_route):void
    {
        $this->addItem(new TextMenuItem($p_tag,$p_text,$p_route));
    }
     
    /**
     * Add an logout menu item
     * 
     * @param unknown $p_tag
     */
    
    function addLogoutItem($p_tag):void
    {
        $this->addItem(new LogoutMenuItem($p_tag));
    }
    
    /**
     * When a child is added to the menu group, this
     * method determines if the widget is a MenuItem) 
     * 
     * @param HtmlComponent $p_component
     * @throws WrongWidgetTypeException
     */
    function validateSubItem(HtmlComponent $p_component)
    {
        if(!($p_component instanceof MenuItem)){
            throw new WrongWidgetTypeException(MenuItem::class, $p_component);
        }
    }
    
   
    function preDisplaySub(DataStore $p_store,Widget $p_item)
    {
        $l_tagValue="";
        $l_tag=$p_item->getTag();
        $l_currentTagValue="";
        $l_currentTag=$this->getCurrentTag();
        if($l_currentTag){
            $l_currentTagValue=$l_currentTag->getValue($p_store);
        }
        if($l_tag){
            $l_tagValue=$l_tag->getValue($p_store);
        }

        if($l_tagValue == $l_currentTagValue){
            $this->theme->menu_LeftMenu->selectedMenu();
        }
    }
    
    function postDisplaySub(DataStore $p_store,Widget $p_item)
    {
        $l_tagValue="";
        $l_tag=$p_item->getTag();
        $l_currentTagValue="";
        $l_currentTag=$this->getCurrentTag();
        if($l_currentTag){
            $l_currentTagValue=$l_currentTag->getValue($p_store);
        }
        if($l_tag){
            $l_tagValue=$l_tag->getValue($p_store);
        }
        
        if($l_tagValue == $l_currentTagValue){
            $this->theme->menu_LeftMenu->selectedMenuFooter();
        }
    }
    
    /**
     * Displays the menu group.
     * First the title is displayed, then all menu items (the children of the menu group)
     * are printed  below the group title.
     * When the menu item has the same tag value as the currentTag of the menu,
     * the menu item is highlighted (to indicate which menu item is selected)
     * 
     */
    function displayContent(DataStore $p_store):void
    {
        $l_title=$this->getAttValue("title", $p_store,"string",true);
        
        $this->theme->menu_LeftMenu->menuGroup($l_title);
        $this->displaySub($p_store);
    }
}
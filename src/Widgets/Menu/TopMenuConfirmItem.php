<?php

declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;

class TopMenuConfirmItem extends TopMenuItemBase
{
    private $confirmMessage;
    
    /**
     * After the message is displayed a confirm message is displayed.
     * 
     * @param DynamicValue $p_confirmMessage
     */
    function setConfirmMessage(DynamicValue $p_confirmMessage):void
    {
        $this->confirmMessage = $p_confirmMessage;        
    }
    
    /**
     * Get the confirm message
     * @return DynamicValue|NULL Confirm message. This is a string wrapped in a DynamicValue
     */
    function getConfirmMessage():?DynamicValue
    {
        return $this->confirmMessage;
    }
    
    /**
     * Displays the menu item.
     * The menu item is a text link to some given url. There can be a icon
     * in front of the url when the icon url is set.
     *
     * @param DataStore $p_store Data used to get the values of the text,link and icon url
     */
    function displayContent(DataStore $p_store):void
    {
        $l_url=$this->getAttValue("url",$p_store, "string",true);
        $l_icons=$this->getAttValue("icon",$p_store,"string");
        $l_text=$this->getAttValue("text", $p_store,"string",true);
        $l_confirmMessage=$this->getAttValue("confirmmessage",$p_store,"string",true);
        $this->theme->menu_TopMenu->topMenuItemConfirm($l_url, $l_text, $l_icons,$l_confirmMessage);
    }
}
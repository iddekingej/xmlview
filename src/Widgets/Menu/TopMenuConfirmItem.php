<?php

declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use Illuminate\Cache\DatabaseStore;
use XMLView\Engine\Data\DynamicValue;

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
     * @param DatabaseStore $p_store Data used to get the values of the text,link and icon url
     */
    function displayContent(DatabaseStore $p_store):void
    {
        if($this->getText() && $this->getRoute()){
            $l_text=$this->getValue("text",$p_store, "string",true);
            $l_route=$this->getValue("route",$p_store, "string",true);
            $l_params=$this->getValue("params",$p_store,"array",true);
            $l_icons=$this->getValue("icon",$p_store,"string");
            $l_confirmMessage=$this->getValue("confirmmessage",$p_store,"string",true);
            if($l_params===null){
                $l_params=[];
            }
            
            $this->theme->menu_TopMenu->topMenuItemConfirm($l_route, $l_params, $l_text, $l_icons,$l_confirmMessage);
        }
    }
}
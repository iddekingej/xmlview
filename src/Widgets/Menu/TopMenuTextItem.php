<?php 

declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Engine\Data\DataStore;

class TopMenuTextItem extends TopMenuItemBase
{
 
    
    /**
     * Displays the menu item.
     * The menu item is a text link to some given url. There can be a icon
     * in front of the url when the icon url is set.
     * 
     * @param DataStore $p_store Data used to get the values of the text,link and icon url
     */
    function displayContent(DataStore $p_store):void
    {
        if($this->getText() && $this->getRoute()){
            $l_text=$this->getAttValue("text",$p_store, "string",true);
            $l_route=$this->getAttValue("route",$p_store, "string",true);
            $l_params=$this->getAttValue("params",$p_store,"array",false);
            $l_icons=$this->getAttValue("icon",$p_store,"string");

            if($l_params===null){
                $l_params=[];
            }
            
            $this->theme->menu_TopMenu->topMenuItem($l_route, $l_params, $l_text, $l_icons);
        }
    }
}
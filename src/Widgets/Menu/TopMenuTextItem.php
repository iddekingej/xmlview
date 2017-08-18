<?php 

declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use Illuminate\Cache\DatabaseStore;

class TopMenuTextItem extends TopMenuItemBase
{
 
    
    /**
     * Displayes the menu item.
     * The menu item is a text link to some given url. There can be a icon
     * in front of the url when the icon url is set.
     * 
     * @param DatabaseStore $p_store Data used to get the values of the text,link and icon url
     */
    function displayContent(?DatabaseStore $p_store)
    {
        if($this->getText() && $this->getRoute()){
            $l_text=$this->getValue("text",$p_store, "string",true);
            $l_route=$this->getValue("route",$p_store, "string",true);
            $l_params=$this->getValue("params",$p_store,"array",true);
            $l_icons=$this->getValue("icon",$p_store,"string");

            if($l_params===null){
                $l_params=[];
            }
            
            $this->theme->menu_TopMenu->topMenuItem($l_route, $l_params, $l_text, $l_icons);
        }
    }
}
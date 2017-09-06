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
        
        $l_text=$this->getAttValue("text",$p_store, "string",true);
        $l_url=$this->getAttValue("url",$p_store,"string",true);
        $l_icons=$this->getAttValue("icon",$p_store,"string");
            
        $this->theme->menu_TopMenu->topMenuItem($l_url, $l_text, $l_icons);
        
    }
}
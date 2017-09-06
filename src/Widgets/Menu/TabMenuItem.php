<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;

class TabMenuItem extends Widget
{
    private $text;
    private $url;
    private $tag;
    
    function setTag(DynamicValue $p_tag):void
    {
        $this->tag=$p_tag;
    }
    
    function getTag():?DynamicValue
    {
        return $this->tag;
    }
    
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    function getText():DynamicValue
    {
        return $this->text;
    }
    
    function setUrl(DynamicValue $p_url):void
    {
        $this->url=$p_url;
    }
    
    function getUrl():DynamicValue
    {
        return $this->url;
    }
    
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
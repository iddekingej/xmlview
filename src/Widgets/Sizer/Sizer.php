<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Sizer;


use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;
use XMLView\Base\SubList;

abstract class Sizer extends Widget
{
    use SubList;
    
    function displayItem(Widget $p_widget,DataStore $p_store)
    {
        $l_css="";
        
        $l_height=$p_widget->getAttValue("containerHeight", $p_store,"string",true);
        $l_width=$p_widget->getAttValue("containerWidth",$p_store,"string",true);
        if($l_height){
            $l_css .= "height:$l_height;";
        }
        if($l_width){
            $l_css .= "width:$l_width;";
        }
        
        $this->theme->base_Sizer->cellHeader($l_css);
        $p_widget->display($p_store);
        $this->theme->base_Sizer->cellFooter();
    }
}
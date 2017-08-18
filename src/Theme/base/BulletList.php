<?php 
declare(strict_types=1);
namespace XMLView\Theme\Base;


use XMLView\Widgets\Base\ThemeItem;

class BulletList extends ThemeItem
{
    function listHeader()
    {
        ?><ul><?php         
    }
    
    function itemHeader()
    {
        ?><li><?php 
    }
    
    function itemFooter()
    {
        ?></li><?php   
    }
    
    function listFooter()
    {
        ?></ul><?php    
    }
}
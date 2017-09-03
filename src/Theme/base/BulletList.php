<?php 
declare(strict_types=1);
namespace XMLView\Theme\Base;


use XMLView\Widgets\Base\ThemeItem;

class BulletList extends ThemeItem
{
    function listHeader():void
    {
        ?><ul><?php         
    }
    
    function itemHeader():void
    {
        ?><li><?php 
    }
    
    function itemFooter():void
    {
        ?></li><?php   
    }
    
    function listFooter():void
    {
        ?></ul><?php    
    }
}
<?php 
declare(strict_types=1);
namespace XMLView\Theme\Base;

use XMLView\Widgets\Base\ThemeItem;

class Table extends ThemeItem
{
    
    function tableHeader()
    {
        ?><table class='tablevc_table'><?php        
    }
    
    function tableTitle(int $p_colSpan,string $p_title):void
    {
        ?><tr><td class='tablevc_title' colspan='<?=$p_colSpan?>'><?=$this->e($p_title)?></td></tr><?php
    }
    
    function rowHeader()
    {
        ?><tr><?php    
    }
    
    function rowFooter()
    {
        ?></tr><?php 
    }
    
    function tableFooter()
    {
        ?></table><?php
    }
    
    /**
     * Print Icon link
     * 
     * @param string $p_href   url of link
     * @param string $p_icon   icon url
     */
    
    function iconLink(string $p_href,string $p_icon):void
    {
        echo static::tag("a")->property("href",$p_href)->inner("img")->property("src",$p_icon)->endInner();
    }
    
    function headerBegin():void
    {
        ?><tr><?php 
    }
    function columnHeader(string $p_title):void
    {
        ?><td class="table_header"><?=$this->theme->e($p_title)?></td><?php
    }
    
    function headerEnd():void
    {
        ?></tr><?php    
    }
    
    function link(string $p_url,string $p_text):void
    {
        echo static::tag("a")->property("href",$p_url)->text($p_text);
        
    }
}
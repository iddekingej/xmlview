<?php
declare(strict_types=1);
namespace XMLView\Theme\Menu;


use XMLView\Widgets\Base\ThemeItem;

class TabMenu extends ThemeItem
{
    function menuHeader()
    {
        ?><table class="pagemenu_table"><tr><?php 
    }
    
    private function menuItemGen($p_url,$p_description,$p_class)
    {
        ?>
        <td class="pagemenu_cell">
        	<div class="<?=$this->e($p_class)?>">
        		<nobr><a class='pagemenu_link' href="<?=$this->e($p_url)?>"><?=$this->e($p_description)?></a></nobr>
        	</div>
        </td>
        <?php      
    }
    
    function menuItem($p_url,$p_description)
    {
        $this->menuItemGen($p_url,$p_description,"pagemenu_item");   
    }
    
    function menuItemSelected($p_url,$p_description)
    {
        $this->menuItemGen($p_url,$p_description,"pagemenu_selected");
    }
    function menuFooter()
    {
        ?><td style='width:100%'></td></tr></table><?php 
    }
}
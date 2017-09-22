<?php 
declare(strict_types=1);
namespace XMLView\Theme\Base;


use XMLView\Widgets\Base\ThemeItem;

class Text extends ThemeItem
{
    
    function divText(string $p_class,string $p_text)
    {
        ?><div <?php if($p_class){?> class="<?=$this->e($p_class)?>" <?php }?>><?=$this->e($p_text)?></div><?php  
    }
}
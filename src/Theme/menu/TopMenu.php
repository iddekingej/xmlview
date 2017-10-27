<?php 
declare(strict_types=1);
namespace XMLView\Theme\Menu;

use XMLView\Widgets\Base\ThemeItem;

class TopMenu extends ThemeItem
{
    function topMenuHeader()
    {
        ?>
<div class="topMenu">
	<?php
    }

    function topMenuItem($p_url, $p_title,$p_icon)
    {
        ?>
		<span class="topMenuItem">
			<a class='topMenuLink' href='<?=$this->e($p_url)?>'>
			<?php if($p_icon){?>
			<img src='<?=self::e($p_icon)?>' />
			<?php }?>
			<?=self::e($p_title)?>
			</a>
		</span>
	<?php
    }

    function topMenuItemConfirm(string $p_url, string $p_title,?string $p_icon, string $p_message):void
    {
        $l_js = $this->theme->confirmJs($p_message, $p_url);
        ?>
			<span class="topMenuItem">
				<a class='topMenuLink' href='#' onclick='<?=self::e($l_js)?>'>
				<?php if($p_icon){?>
					<img src='<?=self::e($p_icon)?>' />
				<?php }?>
				<?=self::e($p_title)?>
				</a>
			</span>
		<?php
    }

    function topMenuFooter()
    {
        ?>
		</div>
<?php
    }
}
<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Engine\Data\DynamicValue;
use XMLView\Widgets\Base\Widget;

/**
 * 
 * Menu item used in LeftMenu. This object is added to
 * a MenuGroup
 *
 */
abstract class MenuItem extends Widget
{
    private $tag;
    

    function setTag(DynamicValue $p_tag):void
    {
        $this->tag=$p_tag;
    }
    
    function getTag():?DynamicValue
    {
        return $this->tag;
    }

}
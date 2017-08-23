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
    
/**
 * The the current tag (This value is used for determine which 
 * menu item is selected)
 * 
 * @param DynamicValue $p_tag Tag of the menu. This a string wrapped in a @see DynamicValue
 */
    function setTag(DynamicValue $p_tag):void
    {
        $this->tag=$p_tag;
    }
 /**
  * Get the tag of the menu item
  * 
  * @return DynamicValue|NULL
  */  
    function getTag():?DynamicValue
    {
        return $this->tag;
    }

}
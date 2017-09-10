<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Base\SubList;
use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\HtmlComponent;

/** 
 * A tab menu is a horizontal menu with items
 * displayed as a tab
 *
 */
class TabMenu extends Widget
{
    use SubList;
    
    /**
     * The tag of the current selected item
     * 
     * @var DynamicValue
     */
    private $currentTag;
    
    /**
     * Set the current tag of the current selected menu
     * 
     * @param DynamicValue $p_tag
     */
    function setCurrentTag(DynamicValue $p_tag)
    {
        $this->currentTag=$p_tag;
    }
    
    
    /**
     * Get the current tag
     * @return DynamicValue
     */
    function getCurrentTag():DynamicValue
    {
        return $this->currentTag;
    }
    
    /**
     * This can only have childeren based on the @see TabMenuItem widget.
     */
    function validateSubItem(HtmlComponent $p_compontent):void
    {
        if(!$p_compontent instanceof TabMenuItem){
            throw new WrongWidgetTypeException(TabMenuItem::class, $p_compontent) ;
        }
    }
    
    /**
     * Display the menu
     *
     * @param DataStore $p_store Data used for the 
     */
    function displayContent(DataStore $p_store):void
    {
        $this->theme->menu_TabMenu->menuHeader();
        $this->displaySub($p_store);
        $this->theme->menu_TabMenu->menuFooter();
    }
}
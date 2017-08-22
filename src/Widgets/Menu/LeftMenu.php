<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;


use XMLView\Widgets\Base\Widget;
use XMLView\Base\SubList;
use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Widgets\Base\WrongWidgetTypeException;

/**
 * 'LeftMenu' class. Displays a vertical menu 
 *
 */
class LeftMenu extends Widget
{
    use SubList;

    /**
     * Current selected menu item
     * @var unknown
     */
    private $currentTag;
    
    function validateSubItem(HtmlComponent $p_component)
    {
        if(!($p_component instanceof MenuGroup)){
            throw new WrongWidgetTypeException(MenuGroup::class, $p_component);
        }
    }
   
    
    /**
     * Set the "CurrentTag'. The menu element with this tag is higlighted to indicate the current selected
     * menu item
     * @param unknown $p_currentTag
     */
    
    function setCurrentTag(DynamicValue $p_currentTag):void
    {
        $this->currentTag=$p_currentTag;
    }
    
    function getCurrentTag():?DynamicValue
    {
        return $this->currentTag;
    }
    
    /**
     * Displays the menu
     * {@inheritDoc}
     * @see \App\Vc\Lib\HtmlComponent::display()
     */
    function displayContent(DataStore $p_store):void
    {
        foreach($this->subItems as $l_group){
            $l_group->display($p_store);
        }
    }
}
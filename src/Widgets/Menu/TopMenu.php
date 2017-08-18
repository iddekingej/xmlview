<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;
use XMLView\SubList;
use XMLView\HtmlComponent;
use XMLView\Widgets\Base\WrongWidgetTypeException;

/**
 * 
 * Another horizontal menu 
 *
 */

class TopMenu extends Widget
{
    use SubList;
    
    function __construct()
    {
        parent::__construct();
        $this->setContainerWidth("100%");
        $this->setContainerHeight("0px");
        
    }
 
    
     function validateSubItem(HtmlComponent $p_compontent)
     {
         if($p_compontent instanceof TopMenuItemBase){
             throw new WrongWidgetTypeException(TopMenuItemBase::class, $p_compontent) ;
         }
     }
    
    /**
     * Display menu 
     * 
     * {@inheritDoc}
     * @see \XMLView\HtmlComponent::display()
     */
    function display(?DataStore $p_store=null):void
    {
        if($this->items){
            $this->theme->menu_TopMenu->topMenuHeader();
            foreach($this->subItems as $l_item){
                $l_item->display();
            }
           $this->theme->menu_TopMenu->topMenuFooter();
        }
    }
}
<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;
use XMLView\Widgets\Base\WrongWidgetTypeException;
use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Base\SubList;
use XMLView\Engine\Data\DynamicStaticValue;

/**
 * 
 * Another horizontal menu 
 *
 */

class TopMenu extends Widget
{
    use SubList;
    
    /**
     * Setup menu
     */
    function __construct()
    {
        parent::__construct();        
        $this->setContainerHeight(new DynamicStaticValue("0px"));
        
    }
 
    /**
     * TopMenu can only have childeren based on the @see TopMenuItemBase widget.
     */
     function validateSubItem(HtmlComponent $p_compontent):void
     {
         if(!$p_compontent instanceof TopMenuItemBase){
             throw new WrongWidgetTypeException(TopMenuItemBase::class, $p_compontent) ;
         }
     }
    
    /**
     * Display the menu 
     * 
     * When the menu has sub items it prints a menu header, the sub items and a footer
     */
    function displayContent(DataStore $p_store):void
    {
        if($this->subItems){
            $this->theme->menu_TopMenu->topMenuHeader();
            foreach($this->subItems as $l_item){
                $l_item->display($p_store);
            }
           $this->theme->menu_TopMenu->topMenuFooter();
        }
    }
}
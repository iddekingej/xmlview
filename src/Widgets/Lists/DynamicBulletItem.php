<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;
use XMLView\Base\SubList;

/**
 * This class is for dynamic bullet list.
 * The children of this components defines the layout of the each bullet item.
 * The Data variable contains a iterable list of data.
 * The layout is repeated for each item from the list using the item as data.
 */
class DynamicBulletItem extends Widget
{
    use SubList;
    
    /**
     * List of data used in displaying the Bullet list. 
     * 
     * @var DynamicValue
     */
    private $data;
    
    function setData(DynamicValue $p_data):void
    {
        $this->data=$p_data;
    }
    
    /**
     * Get the data for the bullet list.
     * @return DynamicValue|NULL
     */
    function getData():?DynamicValue
    {
        return $this->data;
    }
    
    /**
     * Displays the list.
     * This routines iterates through the data. For each item the child element display is called
     * using the item as data. 
     */
    function displayContent(?DataStore $p_store)
    {
        $l_data=$this->getAttValue("data",$p_store,"",true);
        $l_items=$this->subItems;
        foreach($l_data as $l_row){
            $this->theme->base_BulletList->itemHeader();            
            foreach($l_items as $l_item){
                $l_item->display($l_row);
            }
            $this->theme->base_BulletList->itemFooter();            
        }
    }
}
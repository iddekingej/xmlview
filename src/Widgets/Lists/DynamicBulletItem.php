<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;
use XMLView\Base\SubList;


class DynamicBulletItem extends Widget
{
    use SubList;
    
    /**
     * List of data used for 
     * 
     * @var DynamicValue
     */
    private $data;
    
    function setData(DynamicValue $p_data):void
    {
        $this->data=$p_data;
    }
    
    function getData():?DynamicValue
    {
        return $this->data;
    }
    
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
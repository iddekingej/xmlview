<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;
use XMLView\Base\SubList;


class BulletList extends Widget
{
    use SubList;
    
    function displayContent(?DataStore $p_store=null)
    {
        $this->theme->base_BulletList->listHeader();
        foreach($this->subItems as $l_item) {
            $l_item->display($p_store);
        }
        $this->theme->base_BulletList->listFooter();
    }
}
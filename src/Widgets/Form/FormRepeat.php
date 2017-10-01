<?php
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use XMLView\Widgets\Form\FormElement;
use XMLView\Engine\Data\MapData;
use XMLView\Base\SubList;
use XMLView\Engine\Data\DataStore;

class FormRepeat extends FormElement
{
    use SubList;

    
    function displayContent(DataStore $p_store):void
    {
        $l_name=$this->getName();
        $l_data=$p_store->getValue($l_name);
        foreach($l_data as $l_row){
            $l_store=new MapData($p_store,$l_row);
            $this->displaySub($l_store);
        }
    }
}
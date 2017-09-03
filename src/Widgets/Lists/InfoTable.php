<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;

use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Widgets\Base\WrongWidgetTypeException;
use XMLView\Base\SubList;
use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Engine\Data\DynamicStaticValue;

/**
 * Displays a information table.
 * This table has 2 columns. 
 * - On the left is a label.
 * - On the right is a information item. 
 */
class InfoTable extends Widget
{
    use SubList;
    
    private $title;
    
    /**
     * In this constructor the height is set a minimal as possible
     */
    function __construct()
    {
        parent::__construct();
        $this->setContainerHeight(new DynamicStaticValue("0px"));
    }
    
    /**
     * Above the table there is a title.
     * 
     * @param string $p_title Title of the information table
     */
    function setTitle(DynamicValue $p_title):void
    {
        $this->title=$p_title;
    }
    
    /**
     * Get the title of the information table 
     * 
     * @return string the title of of the table
     */
    function getTitle():?DynamicValue
    {
        return $this->title;
    }
    
    function validateSubItem(HtmlComponent $p_component)
    {
        if(!($p_component instanceof InfoTableItem)){
            throw new WrongWidgetTypeException(InfoTableItem::class, $p_component);
        }
    }
    /**
     * This components displays a table.
     * The column on the left contains labels and on the right are values.     
     */
    function displayContent(DataStore $p_store):void
    {
        $l_title=$this->getAttValue("title", $p_store,"string",true);
        $this->theme->base_InfoTable->header($l_title);
        foreach($this->subItems as $l_item){
            $l_item->display($p_store);
        }
        $this->theme->base_InfoTable->footer();
        
    }
}
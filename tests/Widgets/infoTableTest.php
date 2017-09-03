<?php 

use XMLView\Widgets\Lists\InfoTable;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Widgets\Lists\InfoTableText;
use XMLView\Engine\Data\MapData;

class infoTableTest extends XMLViewTest
{
    const TITLE="My title xxx";
    const LABEL="XXX LABEL XX";
    const VALUE="XXX VALUE XXX";
    function test1()
    {
        $l_view=new InfoTable();
        $l_view->setTitle(new DynamicStaticValue(static::TITLE));
        $this->expectOutputRegex("/".static::TITLE."/s");
        $l_data=new MapData(null);
        $l_view->display($l_data);
    }
    
    function test2()
    {
        $l_view=new InfoTable();
        $l_view->setTitle(new DynamicStaticValue(static::TITLE));
        $l_row=new InfoTableText();
        $l_row->setLabel(new DynamicStaticValue(static::LABEL));
        $l_row->setText(new DynamicStaticValue(static::VALUE));
        $l_view->add($l_row);
        $l_data=new MapData(null);
        $this->expectOutputRegex("/".static::LABEL.".*".static::VALUE."/s");        
        $l_view->display($l_data);
    }
}
<?php 
use XMLView\Widgets\Menu\TopMenu;
use XMLView\Engine\Gui\XMLGUIParser;
use XMLView\Engine\Data\MapData;

class menuTest extends XMLViewTest
{
    private function xmlTest($p_name)
    {
        $l_parser=new XMLGUIParser();
        $l_result=$l_parser->parseXML($p_name,null);
        $l_gui=new stdClass();
        return eval($l_result);
    }
    function testTopMenu()
    {
        $l_test=$this->xmlTest("topMenu.xml");
        $this->assertInstanceOf(TopMenu::class,$l_test);
        $l_store=new MapData(null);
        $l_test->display($l_store);
        $this->assertEquals(1,1);
    }
    
    function testTopMenuItem()
    {
        $l_test=$this->xmlTest("topMenuItem.xml");
        $this->assertInstanceOf(TopMenu::class,$l_test);
        $l_store=new MapData(null,["params"=>["bla"=>"xx"]]);
        $l_test->display($l_store);
        $this->assertEquals(1,1);
    }
}
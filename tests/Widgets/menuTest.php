<?php 
use XMLView\Widgets\Menu\TopMenu;
use XMLView\Engine\Gui\XMLGUIParser;
use XMLView\Engine\Data\MapData;
use XMLView\Widgets\Menu\LeftMenu;
use XMLView\Widgets\Menu\MenuGroup;
use XMLView\Engine\Data\DynamicVarValue;
use XMLView\Widgets\Menu\TextMenuItem;
use XMLView\Engine\Data\DynamicStaticValue;

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
    function getLeftMenuCondition()
    {
        $l_menu=new LeftMenu();
        $l_group=new MenuGroup();
        $l_group->setTitle(new DynamicStaticValue("hello"));
        $l_group->setVisible(new DynamicVarValue("var1"));
        $l_menu->add($l_group);
        $l_menuItem=new TextMenuItem();
        $l_menuItem->setRoute(new DynamicStaticValue("test.route"));
        $l_menuItem->setParams((new DynamicStaticValue(["a"=>"b"])));
        $l_menuItem->setText(new DynamicStaticValue("zzz"));
        $l_menuItem->setVisible(new DynamicVarValue("var2"));
        $l_group->add($l_menuItem);
        $l_menuItem=new TextMenuItem();
        $l_menuItem->setRoute(new DynamicStaticValue("test.route"));
        $l_menuItem->setParams((new DynamicStaticValue(["a"=>"b"])));
        $l_menuItem->setText(new DynamicStaticValue("vvvv"));       
        $l_group->add($l_menuItem);
        
        return $l_menu;
    }
    
    function testCondition1()
    {
        $l_store=new MapData(null,["var1"=>true,"var2"=>true]);
        $l_menu=$this->getLeftMenuCondition();
        $this->expectOutputRegex('/^(.*)hello(.*)zzz(.*)$/s');
        $l_menu->display($l_store);
    }
    
    function testCondition2()
    {
        $l_store=new MapData(null,["var1"=>true,"var2"=>false]);
        $l_menu=$this->getLeftMenuCondition();
        $this->expectOutputRegex('/^((?!zzz).)*$/s');
        $l_menu->display($l_store);
    }
}
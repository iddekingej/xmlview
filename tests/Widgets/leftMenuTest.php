<?php 

use XMLView\Widgets\Menu\LeftMenu;
use XMLView\Engine\Data\MapData;
use XMLView\Widgets\Menu\MenuGroup;
use XMLView\Widgets\Menu\TextMenuItem;
use XMLView\Engine\Data\DynamicStaticValue;

class leftMenuTest extends XMLViewTest
{
    function testLeftMenu(){
        $l_store=new MapData(null);
        $l_menu=new LeftMenu();
        $l_menu->display($l_store);
        $this->assertEquals(1,1);
    }
    
    function testLeftMenuGroup()
    {
        $l_store=new MapData(null);
        $l_store=new MapData(null);
        $l_menu=new LeftMenu();
        $l_group=new MenuGroup();
        $l_group->setTitle(new DynamicStaticValue("bla"));        
        $l_menu->add($l_group);
        $l_menu->display($l_store);
    }
    
    function testLeftMenuItem()
    {
        $l_store=new MapData(null);
        $l_store=new MapData(null);
        $l_menu=new LeftMenu();
        $l_group=new MenuGroup();
        $l_group->setTitle(new DynamicStaticValue("bla"));
        $l_menu->add($l_group);
        $l_menuItem=new TextMenuItem();
        $l_menuItem->setText(new DynamicStaticValue("bbbb"));
        $l_menuItem->setRoute(new DynamicStaticValue("me.route"));
        $l_menuItem->setParams(new DynamicStaticValue(["aa"=>"xxx"]));
        $l_group->addItem($l_menuItem);
        $l_menu->display($l_store);
    }
}
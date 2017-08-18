<?php 
use XMLView\Engine\Data\DataNotFoundException;
use XMLView\Engine\Data\MapData;

class mapDataTest extends XMLViewTest
{
    const OneValue="some value";
    const ParentValue="Other value";
    const OtherParentValue="XXXX";
    function testOneMap()
    {
        $l_map=new MapData(null);
        $l_map->setValue("bla",static::OneValue);
        $this->assertEquals(static::OneValue,$l_map->getValue("bla"));
    }
        
    function testNotFound()
    {
        $this->expectException(DataNotFoundException::class);
        $l_map=new MapData(null);
        $l_map->getValue("Does not exists");
    }
    
    function testParent1Test()
    {
        $l_parent=new MapData(null);
        $l_parent->setValue("aa",Static::ParentValue);
        $l_child=new MapData($l_parent);
        $this->assertEquals(Static::ParentValue,$l_child->getValue("aa"));
        $l_child->setValue("aa",Static::OtherParentValue);
        $this->assertEquals(Static::OtherParentValue,$l_child->getValue("aa"));
        $this->assertEquals(Static::ParentValue,$l_parent->getValue("aa"));
    }
}
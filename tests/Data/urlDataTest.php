<?php 

use XMLView\Engine\Data\DynamicUrlItem;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Engine\Data\DynamicVarValue;
use XMLView\Engine\Data\MapData;

class  urlDataTest extends XMLViewTest
{
    function test1()
    {
        $l_test=new DynamicUrlItem();
        $l_test->setRoute(new DynamicStaticValue("xxx"));
        $l_test->setXX(new DynamicStaticValue("a"));
        $l_test->setYY(new DynamicVarValue("b"));
        $l_store=new MapData(null);
        $l_store->setValue("b", "qqq");
        $l_value=$l_test->getValue($l_store);
        $this->assertEquals("http://xxx?XX=a&YY=qqq",$l_value);
    }
}
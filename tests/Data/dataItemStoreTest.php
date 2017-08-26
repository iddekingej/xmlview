<?php 
use XMLView\Engine\Data\DataItemStore;

require_once "DummyStoreClass.php";
class dataItemStoreTest extends XMLViewTest
{
    const VALUE_B="bzzzz";
    const VALUE_C="qqqq";
    
    // Test if getting value works
    function testGet()
    {
        $l_dummy=new DummyStoreClass("xxxxa",static::VALUE_B);
        $l_wrap=new DataItemStore(null, $l_dummy);
        $this->assertEquals(static::VALUE_B,$l_wrap->getValue("b"));
    }
    
    //Can I set a value
    function testSet()
    {
        $l_dummy=new DummyStoreClass("xxxxa",static::VALUE_B);
        $l_wrap=new DataItemStore(null, $l_dummy);
        $l_wrap->setValue("c",static::VALUE_C);
        $this->assertEquals(static::VALUE_C,$l_wrap->getValue("c"));
    }
    //Setting a value shouldn't change the object value
    function testDontChangeObject()
    {
        $l_dummy=new DummyStoreClass("xxxxa",static::VALUE_B);
        $l_wrap=new DataItemStore(null, $l_dummy);
        $l_wrap->setValue("b",static::VALUE_C);
        $this->assertEquals(static::VALUE_B,$l_wrap->getValue("b"));
    }
}
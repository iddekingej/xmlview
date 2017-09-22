<?php 
declare(strict_types=1);

use XMLView\Widgets\Form\Form;
use XMLView\Engine\Data\MapData;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Widgets\Form\FormPassword;
class formTest extends XMLViewTest
{
    const CANCEL_TEXT="BLA##XX123aa";
    const CANCEL_URL="xx123AA";
    const SUBMIT_URL="http://localhost";
    function testForm1()
    {
        $l_store=new MapData(null);
        $l_form=new Form();
        $l_form->setUrl(new DynamicStaticValue(static::SUBMIT_URL));
        $l_store->setValue("bla",1);
        $l_page=new  TestPage();
        $l_page->add($l_form);
        $l_page->display($l_store);
        $this->assertTrue(true);
    }
    
    function testPassword()
    {
        $l_widget=new FormPassword();
        $l_widget->setName("bla");
        $l_widget->setLabel(new DynamicStaticValue("qq"));
        $l_widget->setRowId("row1");
        $l_widget->setId("www");
        $l_store= new MapData(null,["bla"=>"xxuvv"]);
        $this->expectOutputRegex("/bla(.*)[\"]xxuvv[\"]/s");
        $l_widget->display($l_store);
    }
    
    function testCancelButton()
    {
        $l_form=new Form();
        $l_form->setCancelText(new DynamicStaticValue(static::CANCEL_TEXT));
        $l_form->setcancelUrl(new DynamicStaticValue(static::CANCEL_URL));
        $l_store=new MapData(null);
        $l_page=new  TestPage();
        $l_page->add($l_form);
        $this->expectOutputRegex("/".static::CANCEL_TEXT.".*".static::CANCEL_URL."/s");
        $l_page->display($l_store);
             
    }
}
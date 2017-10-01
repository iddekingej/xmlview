<?php 
declare(strict_types=1);

use XMLView\Widgets\Form\Form;
use XMLView\Engine\Data\MapData;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Widgets\Form\FormPassword;
use XMLView\Widgets\Form\FormText;
use XMLView\Engine\Gui\XMLGUIParser;
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
    
    function testCondition()
    {
        
        $l_form=new Form();
        $l_element=new FormText();
        $l_element->setName("xx");
        $l_element->setLabel(new DynamicStaticValue("yy"));
        $l_data=new MapData(null,["xx"=>"yy","cmd"=>"xxvv"]);
        $l_element->setCondition(new DynamicStaticValue("yy=xx QQ RR"));
        $l_form->add($l_element);
        
        $this->expectOutputRegex("/yy=xx QQ RR/s");
        $l_form->display($l_data);
    }
    
    function testXNKCiondition()
    {
         $l_parser=new XMLGUIParser();
         $l_result=$l_parser->parseXML("xml/form/condition.xml",null);
         $l_gui=new stdClass();
         $l_res=eval($l_result);
         $l_data=new MapData(null,["ee"=>"vv"]);
         $this->assertEquals("zz vv",$l_gui->yy->getAttValue("condition",$l_data,"string"));
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
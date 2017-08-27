<?php 
declare(strict_types=1);

use XMLView\Widgets\Form\Form;
use XMLView\Engine\Data\MapData;
use XMLView\Engine\Data\DynamicStaticValue;
class formTest extends XMLViewTest
{
    function testForm1()
    {
        $l_store=new MapData(null);
        $l_form=new Form();
        $l_form->setUrl(new DynamicStaticValue("http://localhost"));
        $l_store->setValue("bla",1);
        $l_page=new  TestPage();
        $l_page->add($l_form);
        $l_page->display($l_store);
        $this->assertTrue(true);
    }
}
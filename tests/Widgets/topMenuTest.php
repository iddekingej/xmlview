<?php 


use XMLView\Widgets\Menu\TopMenuConfirmItem;
use XMLView\Engine\Data\DynamicStaticValue;

class topMenuTest extends XMLViewTest
{
    function testConfirm()
    {
        $l_confirm=new TopMenuConfirmItem();
        $l_confirm->setText(new DynamicStaticValue("test"));
        $l_confirm->setText(new DynamicStaticValue("confirm message?"));
        $l_confirm->setUrl(new DynamicStaticValue("XXanurlXX"));
        $this->expectOutputRegex("\confirm_message(.*)XXanurlXX\s");
        $this->displayElement($l_confirm,[]);
    }
}
<?php 

use XMLView\Widgets\Text\Note;
use XMLView\Engine\Data\DynamicStaticValue;

class noteTest extends XMLViewTest
{
    const TEXT="fdsfsdfXXX";
    function testNote()
    {
        $l_note=new Note();
        $l_note->setText(new DynamicStaticValue(static::TEXT));
        $this->expectOutputRegex("/".static::TEXT."/s");
        $this->displayElement($l_note);
    }
}
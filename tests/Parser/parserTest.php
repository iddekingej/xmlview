<?php 
use Tests\TestCase;
use XMLView\Engine\Gui\XMLGUIParser;
use XMLView\Widgets\Text\StaticText;


class parserTest extends XMLViewTest
{
    function testInclude()
    {
        $l_parser=new XMLGUIParser();
        $l_result=$l_parser->parseXML("inc.xml",null);
        echo $l_result;
        $l_gui=new stdClass();
        $l_object=eval($l_result);
        $this->assertInstanceOf(StaticText::class,$l_object);
    }
}
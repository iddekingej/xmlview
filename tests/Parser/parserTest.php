<?php 
use XMLView\Engine\Gui\XMLGUIParser;
use XMLView\Widgets\Text\StaticText;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Engine\XMLParserException;
use XMLView\Engine\AttributeDoesntExists;
use XMLView\Engine\Parser\ParseData;

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
    
    function testRef()
    {        
        
        $l_parser=new XMLGUIParser();
        $l_result=$l_parser->parseXML("xml/parser/ref.xml",null);
        $l_gui=new stdClass();        
        $l_res=eval($l_result);        
        $this->assertInstanceOf(StaticText::class,$l_gui->x1);
        $l_text=$l_gui->x1->getText();
        $this->assertInstanceOf(DynamicStaticValue::class,$l_text);
        $this->assertEquals("Bla",$l_text->getStaticValue());
        
    }
    
    function testERef()
    {
        
        $l_parser=new XMLGUIParser();
        $this->expectException(XMLParserException::class);
        $l_result=$l_parser->parseXML("xml/parser/eref.xml",null);
    }
    
    function testERef2()
    {
        
        $l_parser=new XMLGUIParser();
        $this->expectException(XMLParserException::class);
        $l_result=$l_parser->parseXML("xml/parser/eref2.xml",null);
    }
 
    function testEAtt()
    {
        $l_parser=new XMLGUIParser();
        $this->expectException(AttributeDoesntExists::class);
        $l_result=$l_parser->parseXML("xml/parser/eatt.xml",null);
    }
    
    function testUnkNamedItem()
    {
        $l_parserData=new ParseData();
        $l_ni=$l_parserData->getNamedItem("bla");
        $this->assertNull($l_ni);
    }
}
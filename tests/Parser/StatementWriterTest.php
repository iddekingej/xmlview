<?php 
use XMLView\Engine\XMLStatementWriter;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Engine\Data\DynamicVarValue;
use XMLView\Engine\Data\MapData;
use XMLView\Engine\Data\DynamicTranslationValue;

class StatementWriterTest extends XMLViewTest
{
    function testStaticString()
    {
        $l_parser=new XMLStatementWriter();
        $l_parser->setObjectAttribute('bla','xx', 'zzz');
        $l_code=$l_parser->getCode();
        $this->assertEquals("\n\$l_gui->bla->setxx(new ".DynamicStaticValue::class."('zzz'));", $l_code);
    }
    
    function testVar()
    {
        $l_writer=new XMLStatementWriter();
        $l_return=$l_writer->parseToDvData("\${xx}");
        $this->assertEquals("new ".DynamicVarValue::class. "('xx')",$l_return);
    }
    
    function testTranslate()
    {
        $l_writer=new XMLStatementWriter();
        $l_return=$l_writer->parseStringToTranslation("bla \${var} xx \${varb}");        
        $l_object=eval("return $l_return;");
       
        $this->assertInstanceOf(DynamicTranslationValue::class,$l_object);
        $l_store=new MapData(null,["var"=>"zz","varb"=>"qq"]);
        $l_result=$l_object->getValue($l_store);
        $this->assertEquals("bla zz xx qq",$l_result);
    }
}
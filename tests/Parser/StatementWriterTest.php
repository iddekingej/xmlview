<?php 
use Tests\TestCase;
use XMLView\Engine\XMLStatementWriter;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Engine\Data\DynamicVarValue;


class StatementWriterTest extends TestCase
{
    function testStaticString()
    {
        $l_parser=new XMLStatementWriter();
        $l_parser->setObjectAttribute('bla','xx', 'zzz');
        $l_code=$l_parser->getCode();
        $this->assertEquals("\n\$this->gui->bla->setxx(new ".DynamicStaticValue::class."('zzz'));", $l_code);
    }
    
    function testVar()
    {
        $l_writer=new XMLStatementWriter();
        $l_return=$l_writer->parseToDvData("\${xx}");
        $this->assertEquals("new ".DynamicVarValue::class. "('xx')",$l_return);
    }
}
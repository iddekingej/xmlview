<?php 
class _testTest extends XMLViewTest
{
    function testTranslationMock()
    {
        $l_text=__("bla :xx ad :xxb",["xx"=>"A","xxb"=>"cc"]);
        $this->assertEquals("bla A ad cc",$l_text);
    }
}
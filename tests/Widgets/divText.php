<?php 


use XMLView\Widgets\Text\StaticText;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Engine\Data\MapData;
use XMLView\Widgets\Text\DivText;

/**
 * Check @see StaticText widget
 *
 */
class staticTextTest extends XMLViewTest
{
    CONST TEXT="bla xxx <a>ddfsdf";
    
    /**
     * Checks if SetText and GetText returns the same
     */
    function testText()
    {
        $l_st=new DivText();
        $l_st->setText(new DynamicStaticValue(static::TEXT));
        $l_store=new MapData(null);
        $l_text=$l_st->getAttValue("text", $l_store,"string",true);
        $this->assertEquals(static::TEXT,$l_text);
    }    
    
    /**
     * Checks is output is correct
     */
    
    function testOutput()
    {
        $l_st=new DivText();
        $l_st->setText(new DynamicStaticValue(static::TEXT));
        $l_st->setClassName(new DynamicStaticValue("MyClass"));        
        $this->expectOutputRegex("/div(.*)MyClass(.*)".htmlspecialchars(static::TEXT)."/s");
        $this->displayElement($l_st,[]);
    }
    
}
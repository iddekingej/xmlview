<?php 

use XMLView\Engine\Alias\AliasManager;
use XMLView\Engine\Alias\AliasException;
use XMLView\Engine\Alias\AliasList;


class EngineTest extends XMLViewTest
{

    function setup()
    {
        parent::setup();
        AliasManager::resetAliases();        
        AliasManager::addAliasFile("aliases/aliasTest.xml");        
        $this->gui=new stdClass();
    }
    
    function testAlias1()
    {        
        $l_result=AliasManager::getAlias(AliasList::TYPE_ELEMENT, 'test_TestComponent');        
        $this->assertEquals("TestComponent",$l_result);     
    }
    
    function testAlias2()
    {        
        $this->expectException(AliasException::class);
        $l_result=AliasManager::getAlias(AliasList::TYPE_ELEMENT, 'xx###a   aa');
    }
    
}
<?php 
use XMLView\Base\UnknownPropertyException;

require_once "BaseDummy.php";
class baseTest extends XMLViewTest
{
    /**
     * Test if UnknownPropertyException is raised when accessing unkown property
     */
    function testUnkProperties()
    {
        $this->expectException(UnknownPropertyException::class);
        $l_test=new BaseDummy();
        $l_test->testNot();
    }
    /**
     * This must be go OK
     */
    function testExistsProperties()
    {
        $l_test=new BaseDummy();
        $l_test->testExists();
        $this->assertEquals(1,1);
    }
}
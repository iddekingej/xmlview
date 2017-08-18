<?php 
use XMLView\Base\Base;

class BaseDummy extends Base
{
    
    private $exists=1;
    
    function testExists()
    {
        $this->exists=1;
    }
    
    function testNot()
    {
        $this->doesnExists=1;
    }
}
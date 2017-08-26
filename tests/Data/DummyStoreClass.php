<?php 
class DummyStoreClass
{
    public   $a;
    private  $b;
    
    function __construct($p_a,$p_b)
    {
        $this->a=$p_a;
        $this->b=$p_b;
    }
    
    function getB()
    {
        return $this->b;
    }
}
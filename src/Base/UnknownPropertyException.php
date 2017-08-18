<?php
namespace XMLView\Base;

class UnknownPropertyException extends \Exception
{
    function __construct($p_class,string $p_variable){
        parent::__construct("Unknown property ".get_class($p_class)."::".$p_variable);
    }
}
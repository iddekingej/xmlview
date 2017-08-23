<?php
declare(strict_types=1);

namespace XMLView\Base;

/**
 * When deriving from the @see Base class, the object is protected for 
 * reading and writing undefined properties.
 * * 
 *
 */
class UnknownPropertyException extends \Exception
{
    function __construct($p_class,string $p_variable){
        parent::__construct("Unknown property ".get_class($p_class)."::".$p_variable);
    }
}
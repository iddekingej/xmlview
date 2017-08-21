<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;

use XMLView\Base\Base;

/**
 * Used mainly in widget.add method, when the child widget has the wrong type. 
 *
 */
class WrongWidgetTypeException extends \Exception
{
    
    function __construct(string $p_expected,Base $p_found){
        parent::__construct(__("Wrong type of widget ':found', this object doesn't descent from ':expected' excpected",["found"=>get_class($p_found),"expected"=>$p_expected]));
    }
}
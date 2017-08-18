<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;

class WrongWidgetTypeException extends \Exception
{
    function __construct(string $p_expected,\stdObject $p_found){
        parent::__construct(__("Wrong type of widget ':found', this object doesn't descent from ':expected' excpected",["found"=>$p_found,"expected"=>get_class($p_expected)]));
    }
}
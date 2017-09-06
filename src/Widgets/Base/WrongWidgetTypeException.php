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
    
    function __construct(string $p_expected,Base $p_found,$p_file=""){
        if($p_file){
            $l_text=__("Wrong type of widget ':found', this object doesn't descent from ':expected' excpected. Object read from resource file :file",["found"=>get_class($p_found),"expected"=>$p_expected,"file"=>$p_file]);
        } else {
            $l_text=__("Wrong type of widget ':found', this object doesn't descent from ':expected' excpected",["found"=>get_class($p_found),"expected"=>$p_expected]);
        }
        parent::__construct();
    }
}
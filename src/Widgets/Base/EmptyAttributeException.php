<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;


class EmptyAttributeException extends \Exception
{
    function __construct(Widget $p_widget,string $p_name){
        parent::__construct(__("Mandatory attribute ':name' of widget ':class' is null or not set",["name"=>$p_name,"class"=>get_class($p_widget)]));
    }
}
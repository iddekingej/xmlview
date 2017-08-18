<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;


class UnkownAttributeException extends \Exception
{
    function __construct(Widget $p_widget,string $p_name){
        parent::__construct(__("Unknown attribute ':name' of widget ':class'",["name"=>$p_name,"class"=>get_class($p_widget)]));
    }
}
<?php 
declare(strict_types=1);
namespace XMLView\Engine;

interface XMLObject
{
    function addChild(XMLObject $p_child):void;
}
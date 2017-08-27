<?php
declare(strict_types=1);
namespace XMLView\Engine\Parser;

use XMLView\Base\Base;

class ParseData extends Base
{
    private $namedItems=[];
    private $usedFiles=[];
    
    function addNamedItem(string $p_name,ObjectNode $p_item):void
    {
        $this->namedItems[$p_name]=$p_item;
    }
    
    function getNamedItem(string $p_name):?ObjectNode
    {
        if(isset($this->namedItems[$p_name])){
            return $this->namedItems[$p_name];
        }
        return null;
    }
    
    function addUsedFile(string $p_file):void
    {
        $this->usedFiles[$p_file]=1;
    }
    
    function getUsedFiles():array
    {
        return array_keys($this->usedFiles);
    }
}
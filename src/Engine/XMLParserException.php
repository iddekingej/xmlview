<?php 
namespace XMLView\Engine;

class XMLParserException extends \Exception
{
    private $node;
    private $fileName;
    
    function __construct($p_error,?\DOMNode $p_node,\Throwable $p_other=null,string $p_fileName="")
    {
        parent::__construct($p_error,0,$p_other);
        $this->node=$p_node;
        $this->fileName=$p_fileName;
    }
    
    function setFileName(string $p_fileName):void
    {
        $this->fileName=$p_fileName;
    }
    
    function __toString()
    {
        $l_error=parent::__toString();
        if($this->node){
            $l_error .= "\n in node of type ".$this->node->nodeName;
            $l_error .= "\n in line ".$this->node->getLineNo();
        }
        if($this->fileName){
            $l_error .= "\n In file \"".$this->fileName."\"";
        }
        return $l_error;
    }
}
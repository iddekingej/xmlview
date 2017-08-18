<?php
declare(strict_types=1);
namespace XMLView\Engine\Parser;

use XMLView\Engine\XMLStatementWriter;

class ObjectNode extends Node
{
    private $name;
    private $class;
    private $parent;
    private $children=[];
    private $parameters=[];
    private $method;
    
    function __construct(string $p_name,string $p_class,?ObjectNode $p_parent,string $p_method)
    {
        $this->name=$p_name;
        $this->class=$p_class;
        $this->parent=$p_parent;
        $this->method=$p_method;
    }
    
    function setParameters(Array $p_parameters)
    {
        $this->parameters=$p_parameters;
    }
    
    function getParameters()
    {
        return $this->parameters;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getClass()
    {
        return $this->class;
    }
    
    function getParent():ObjectNode
    {
        return $this->parent;
    }
    
    function addChild(ObjectNode $p_child)
    {
        $this->children[]=$p_child;
    }
    
    function compile(XMLStatementWriter $p_writer):void
    {

        $p_writer->makeObject($this->name, $this->class);           
        foreach($this->children as $l_child){
            $l_child->compile($p_writer);
        }

        foreach($this->parameters as $l_name=>$l_expression){
            $p_writer->setObjectAttribute($this->name, $l_name,$l_expression);
        }
        if($this->parent != null){
            $p_writer->addToParent($this->parent->getName(), $this->name,$this->method);
        }
        if($this->parent === null){
            $p_writer->addReturn($this->name);
        }
    }
}
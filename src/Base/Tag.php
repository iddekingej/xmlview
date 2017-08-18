<?php 
declare(strict_types=1);
namespace XMLView\Base;


class TagExcpetion extends \Exception
{
    
}

class Tag extends Base
{
    private $properties;
    private $content;
    private $tag;
    private $parent;
    
    function __construct(String $p_tag)
    {
        $this->tag=$p_tag;
    }

    /**
     * HTML Escape string
     *
     * @param String $p_string
     * @return string
     */
    static function e($p_string): string
    {
        if ($p_string === null) {
            return "";
        }
        return htmlspecialchars("$p_string", ENT_QUOTES | ENT_HTML5);
    }
    
    
    function setParent(Tag $p_parent):void
    {
        $this->parent=$p_parent;
    }
    
    function inner(String $p_tag):Tag
    {
        $l_tag=new Tag($p_tag);
        $l_tag->setParent($this);
        return $l_tag;
    }
    
    function endInner()
    {
        if($this->parent===NULL){
            throw new TagExcpetion("Tag has no parent tag");
        }
        $this->parent->content($this->__toString());
        return $this->parent;
    }
    
    function property(String $p_name,$p_value):Tag
    {
        $this->properties .= " ";        
        $this->properties .= $p_name.'="'.$this->e($p_value).'"';
        return $this;
    }
    
    function class($p_value):Tag
    {
        return $this->property("class",$p_value);
    }
    
    function id($p_value):Tag
    {
        return $this->property("id",$p_value);
    }
    
    function content($p_content):Tag
    {
        $this->content .= $p_content;
        return $this;
    }
    
    function text($p_content):Tag
    {
        return $this->content($this->e($p_content));
    }
    function __toString():string
    {
        return "<".$this->tag.$this->properties.">".$this->content."</".$this->tag.">";       
    }
}
?>
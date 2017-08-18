<?php 
namespace XMLView\Engine;


use XMLView\Engine\Data\DynamicVarValue;
use XMLView\Engine\Data\DynamicStaticValue;
use XMLView\Engine\Data\DynamicSequenceValue;
use XMLView\Base\Base;

class XMLStatementWriter extends Base{
    private $buffer;
    
    function escape(string $p_str){
        return addslashes($p_str);
    }
    
    function isFixedParameter($p_name)
    {        
        return ($p_name=="name");
    }
    
    function addConcat(string &$p_str,$p_new)
    {
        if($p_new){
            if($p_str){
                $p_str .= ".";
            }
            $p_str .= $p_new;
        }
    }
    
    function addConcatStr(string &$p_str,string $p_new)
    {
        if($p_new){
            $this->addConcat($p_str,"\"".$this->escape($p_new)."\"");
        }
    }
    
    function guiVar($p_name)
    {
        
        return "\$this->gui->$p_name";
    }
    
    
    /**
     * Parser string to a DynamicValue expression
     * If expression is:
     * "some string "            =>DynamicStaticValue("some string")
     * "${somevar}               =>DynamicVarValue("somevar")
     * "Error code : ${somevar}" =>DynamicSequenceValue([[0,"Error code :],[1,"somevar"]])
     * 
     * @param stirng $p_stmt
     * @throws XMLParserException
     * @return string
     */
    public function parseToDVData(string $p_stmt){
        $l_start=0;
        $l_dvData=[];
        $l_length=strlen($p_stmt);
        while(true){
            $l_pos=strpos($p_stmt,"\${",$l_start);
            if($l_pos===false){
                if($l_start <$l_length){
                    $l_dvData[]=[DynamicSequenceValue::TYPE_STRING,substr($p_stmt,$l_start,$l_length - $l_start)];
                }
                break;
            }
            if($l_pos > $l_start){
                $l_dvData[]=[DynamicSequenceValue::TYPE_STRING,substr($p_stmt,$l_start,$l_pos-$l_start)];
            }
            
            $l_posEnd=strpos($p_stmt,"}",$l_pos);
            if($l_posEnd===false){
                throw new XMLParserException(__("Missing '}' in statement::stmt",["stmt"=>$p_stmt]),null);
            }
            
            $l_dvData[]=[DynamicSequenceValue::TYPE_VAR,substr($p_stmt,$l_pos+2,$l_posEnd-$l_pos-2)];            
            $l_start=$l_posEnd+1;
        }

        if(count($l_dvData)==1){
            if($l_dvData[0][0]==DynamicSequenceValue::TYPE_STRING){
                return "new ".DynamicStaticValue::class."(".var_export($l_dvData[0][1],true).")";
            }else if($l_dvData[0][0]==DynamicSequenceValue::TYPE_VAR){
                return "new ".DynamicVarValue::class."(".var_export($l_dvData[0][1],true).")";
            } else {
                throw new XMLParserException(__("Invalid value tpe code :   code",$l_dvData[0][0]),null);
            }
        } else {
            return "new ".DynamicSequenceValue::class."(".var_export($l_dvData,true).")";
        }
    }
    
    /**
     * Create statement in which the  object is added to the parent through the specified method
     * 
     * @param unknown $p_parentName   Name of the parent
     * @param unknown $p_name         Name of the item that should be added to the parent
     * @param string $p_method        Object Method function used
     */
    function addToParent($p_parentName,$p_name,string $p_method):void
    {
        $this->buffer .= "\n".$this->guiVar($p_parentName)."->".$p_method."(".$this->guiVar($p_name).");";
    }
    
    /**
     * Produce code for creating a new component
     * 
     * @param string $p_name Component name
     * @param string  $p_className Name of the class
     */
    function makeObject(string $p_name,string $p_className):void
    {
        $this->buffer .= "\n".$this->guiVar($p_name)."=new ${p_className}();";
    }
    
    /**
     * Set attribute of a component/object 
     * 
     * @param string $p_name       Name of component
     * @param string $p_fieldName  Field name to set
     * @param unknown $p_value     
     */
    function setObjectAttribute(string $p_name,string $p_fieldName,$p_value):void
    {
        if($this->isFixedParameter($p_fieldName)){
            $l_value=var_export($p_value,true);
        } else {
            $l_value=$this->parseToDVData($p_value);
        }
        $this->buffer .= "\n".$this->guiVar($p_name)."->set${p_fieldName}(${l_value});";
    }
    
    /**
     * 
     * @param unknown $p_name
     */
    
    function addReturn($p_name)
    {
        $this->buffer .= $this->guiVar($p_name)."->setParent(\$l_parent);";
        $this->buffer .= "\n return ".$this->guiVar($p_name).";";
    }
    
    function getCode()
    {
       return $this->buffer; 
    }
}


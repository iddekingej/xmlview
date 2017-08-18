<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

class DynamicSequenceValue implements DynamicValue
{
    const TYPE_STRING=0;
    const TYPE_VAR=1;
    private $sequences=[];
    
    function addSequence(int $p_type,string $p_value):void
    {
        $this->sequences[]=[$p_type,$p_value];
    }
        
    function getValue(DataStore $p_dataStore)
    {
        $l_return="";
        foreach($this->sequences as $l_sequence){
            if($l_sequence[0]==static::TYPE_STRING){
                $l_return .= $l_sequence[1];
            } else {
                $l_return .= $p_dataStore->getValue($l_sequence[1]);
            }
        }
        return $l_return;
    }
}
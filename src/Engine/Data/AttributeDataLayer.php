<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

use XMLView\Base\Base;

class AttributeDataLayer extends Base implements DataLayer
{
    private $data=[];
    
    function __call($p_name,$p_values)
    {
        if(count($p_values) != 1){
            throw new \BadFunctionCallException(__("Too many parameters in call to :fun, 1 expected but :num found ",["fun"=>$p_name,count($p_value)]));
        }
        $l_value=$p_values[0];
        if(! $l_value instanceof DynamicValue){
            throw new \BadFunctionCallException(__("Invalid parameter type in call to :fun, DynamicValue expected",["fun"=>$p_name]));
        }
        $l_name=strtolower($p_name);
        if(substr($l_name,0,3)=="set"){
            $l_propertyName=substr($l_name,3);
            $this->data[$l_propertyName]=$l_value;
        } else {
            throw  new \BadFunctionCallException(__("Invalid method :method",["class"=>$p_name]));
        }
    }
    
    function processData(DataStore $p_parent):DataStore
    {
        $l_store=new MapData($p_parent);
        foreach($this->data as $l_name=>$l_value){
            $l_value=$l_value->getValue($l_store);
            $l_store->setValue($l_name, $l_value);
        }
        return $l_store;
    }
}
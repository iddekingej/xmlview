<?php
declare(strict_types=1);
namespace XMLView\Engine\Data;

class DynamicUrlItemException extends \Exception
{
    
}

class DynamicUrlItem implements DynamicValue
{
    /**
     * The route part of the url 
     * 
     * @var DynamicValue
     */
    private $route;
    
    /**
     * Array of route parameters
     * 
     * @var array 
     */
    private $parameters=[];
    
    /**
     * Set the parameter of the URL 
     * 
     * @param string $p_name  Parameter name
     * @param DynamicValue $p_value Dynamic value
     */
    function __call($p_name,$p_arguments){
        $l_name=strtolower($p_name);
        if(count($p_arguments) != 1){
            throw new DynamicUrlItemException(__("Invalid number of parameters :num found but 1 expected",["num"=>count($p_arguments)]));             
        }
        $l_value=$p_arguments[0];
        if(substr($l_name,0,3)=="set"){
            $l_name= substr($p_name,3);
            $this->parameters[$l_name]=$l_value;
        }
    }
    /**
     * Set the route part  of the url.
     * 
     * @param DynamicValue $p_route URL route (string) wrapped in a DynamicValue object
     */
    function setRoute(DynamicValue $p_route)
    {
        $this->route=$p_route;       
    }
    
    /**
     * Return the 
     * @return DynamicValue|NULL
     */
    function getRoute():?DynamicValue{
        return $this->route;
    }
    
    /**
     * Calculate the URL value 
     */
    function getValue(DataStore $p_store)
    {
        $l_data=[];
        foreach($this->parameters as $l_name=>$l_parameter){
            $l_data[$l_name]=$l_parameter->getValue($p_store);
        }
        $l_route=$this->route->getValue($p_store);
        return route($l_route,$l_data);
    }
}
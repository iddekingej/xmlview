<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;


interface DataStore
{
    function getParent():DataStore;
    function getValue(string $p_name);
    function setValue(string $p_name,$p_value):void;
    function setValues(Array $p_values):void;

}
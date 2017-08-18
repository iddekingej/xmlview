<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

interface DynamicValue
{
    function getValue(DataStore $p_dataStore);
}
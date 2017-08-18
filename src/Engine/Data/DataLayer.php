<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

interface DataLayer
{
    function processData(DataStore $p_parent):DataStore;    
}

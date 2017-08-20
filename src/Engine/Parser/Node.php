<?php 
declare(strict_types=1);
namespace XMLView\Engine\Parser;

use XMLView\Engine\XMLStatementWriter;

abstract class Node
{
    abstract function compile(XMLStatementWriter $p_writer):void;   
}
<?php 
declare(strict_types=1);
namespace XMLView\Base;

/**
 * Raised in @see HashMap::get when a key doesn't exists.
 *
 */
class UnkownKeyException extends \Exception
{
    function __construct(string $p_key)
    {
        parent::__construct(__("Unkown key ':key'",["key"=>$p_key]));
    }
}
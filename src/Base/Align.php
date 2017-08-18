<?php 
namespace XMLView\Base;
/**
 * Align constants
 *
 */
class Align{
    const LEFT="left";
    const CENTER="center";
    const RIGHT="right";
    
    static function isValid(string $p_align)
    {
        return ($p_align==static::LEFT)||($p_align==static::CENTER)||($p_align==static::RIGHT);
    }
    
    static function validate(string $p_align)
    {
        if(!static::isValid($p_align)){
            throw new \InvalidArgumentException(__("Align value is invalid '%s'",$p_align));
        }
    }
}
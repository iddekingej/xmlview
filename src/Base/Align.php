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
    
    /**
     * Check if align value is valid.
     * 
     * @param string $p_align  Align value.
     * @return boolean         True p_align is valid  false =>not valid
     */
    static function isValid(string $p_align)
    {
        return ($p_align==static::LEFT)||($p_align==static::CENTER)||($p_align==static::RIGHT);
    }
    
    /**
     * Checks if p_align is valid, else a exception is raised
     * 
     * @param string $p_align            Align value to check      
     * @throws \InvalidArgumentException Raised when p_align is not valid.
     */
    static function validate(string $p_align)
    {
        if(!static::isValid($p_align)){
            throw new \InvalidArgumentException(__("Align value is invalid '%s'",$p_align));
        }
    }
}
<?php 
namespace Composer\Autoload;

/** 
 * PHP unit tries to autoload this.
 * I don't know why
 *
 */
class ClassLoader
{
    function loadClass($p_className)
    {
        autoload($p_className);
    }
}
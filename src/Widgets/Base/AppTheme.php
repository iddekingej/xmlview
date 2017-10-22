<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Base;

class AppTheme extends Theme
{
    
    private static $theme;
    /**
     * Get theme singleton
     */
    static function new():Theme
    {
        if(static::$theme===null){            
            static::$theme=new AppTheme();
        }
        return static::$theme;
    }

    function nameToClass(string $p_name):string
    {        
        $l_name=str_replace("_", "\\", $p_name);
        return "App\\Vc\\Theme\\$l_name";
    }
}
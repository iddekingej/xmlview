<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Base;

use XMLView\Base\Base;

class ThemeItem extends Base{
    
    protected $theme;
    
    function __construct(Theme $p_theme)
    {
        $this->theme=$p_theme;       
    }
    
    function __call(String $p_function,Array $p_args)
    {
        return call_user_func_array([$this->theme,$p_function],$p_args);
    }
    
    /**
     * Get the theme manager
     * 
     * @return \App\Vc\Lib\Theme
     */
    
    function getTheme():Theme
    {
        return $this->theme;
    }
    
  

    

}
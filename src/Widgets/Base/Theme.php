<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Base;

use XMLView\Base\Tag;

/**
 * Base object for all theme (html) output
 * @author jeroen
 *
 */

class Theme 
{
    private static $theme;
    /**
     * Get theme singleton     
     */
    static function new():Theme
    {
        if(static::$theme===null){            
            static::$theme=new Theme();
        }
        return static::$theme;
    }
    /**
     * Theme objects are accessed by $theme->namespace1_namespace2_className->method()
     * This routine creates object new \\App\Vcc\Theme\namespace1\namespace2\className()
     * 
     * @param unknown $p_name 
     * @return ThemeItem
     */
    function __get($p_name)
    {
        $l_className=$this->nameToClass($p_name);
        $this->$p_name=new $l_className($this);
        return $this->$p_name;
    }
    
    function nameToClass(string $p_name):string
    {
      $l_appBase="app_";
      if(substr($p_name,0,strlen($l_appBase))==$l_appBase){
            $l_name=str_replace("_", "\\", substr($p_name,strlen($l_appBase)));
            $l_className="App\\Vc\\Theme\\${l_name}";//ToDo: settings for default NS?
        }  else {
            $l_name=str_replace("_", "\\", $p_name);
            $l_className="XMLView\\Theme\\$l_name";
        }
        return $l_className;
    
    }
    
    /**
     * Outputs html attribute and escapes value
     * 
     * @param string  $p_name attribute name     
     * @param unknown $p_value attribute value
     */
    function attribute(string $p_name,$p_value):void
    {
        echo $p_name,'="',$this->e($p_value).'" ';
    }
    
    /**
     * Outputs image tag
     * 
     * @param string $p_src   Image url
     * @param string $p_class Css class of image
     */
    function image($p_src,$p_class=""):void
    {
        echo "<img ";
        $this->attribute("src",$p_src);
        if($p_class){
            $this->attribute("class",$p_class);
        }
        echo ">";        
    }
    
    /**
     * After clicking a icon, a confirmation message is displayed
     * After pressing "yes"
     *
     * @param unknown $p_message
     *            Confirmation message to display
     * @param unknown $p_url
     *            Url to go after click + confirmation
     * @param unknown $p_image
     *            Url of icon/image
     */
    function iconConfirm(string $p_message, string $p_url, string $p_image): void
    {
        $l_js = $this->confirmJs($p_message, $p_url);
        ?><span class="deleteIcon" onclick="<?=$this->e($l_js)?>"><img
    src='<?=$this->e($p_image)?>'></span><?php
    }
    
    /**
     * Displays a link. The Url is given as a route
     * @param unknown $p_route   Name of the route
     * @param array $p_params    Route parameter
     * @param unknown $p_text    Text of url
     * @param string $p_class    Css class of url. Default no class
     */
    function textRouteLink($p_route,Array $p_params,$p_text,$p_class=""):void
    {
        $this->textLink(Route($p_route,$p_params),$p_text,$p_class);
    }
    
    /**
     * Displays link. 
     *  
     * @param unknown $p_url    URL of link
     * @param unknown $p_text   Text of link
     * @param string $p_class   Css class of url. Default no class
     */
    function textLink($p_url,$p_text,$p_class=""):void
    {
        ?><a <?php if($p_class != ""){ $this->attribute("class",$p_class);}?> href="<?=$this->e($p_url)?>"><?=$this->e($p_text)?></a><?php
    }
    
    /**
     * A link consists of a image following by a text
     * @param unknown $p_url    URL of link
     * @param unknown $p_image  Image displayed in link
     * @param unknown $p_text   Text in link
     */
    function imageTextLink($p_url,$p_image,$p_text):void
    {
        ?><a href="<?=$this->e($p_url)?>"><img src="<?=$this->e($p_image)?>" /><?=$this->e($p_text)?></a><?php   
    }
    
    function iconLink(string $p_route,Array $p_data,string $p_icon):void
    {
       ?><a href="<?=$this->e(route($p_route,$p_data))?>"><?php $this->image($p_icon)?></a><?php 
    }

    function iconTextRouteLink($p_route,array $p_params,$p_image,$p_text):void
    {
        ?><a href="<?=$this->e(Route($p_route,$p_params))?>"><img src="<?=$this->e($p_image)?>" /></a><a href="<?=$this->e(Route($p_route,$p_params))?>"><?=$this->e($p_text)?></a><?php
    }
    
    
    /**
     * HTML Escape string
     *
     * @param String $p_string
     * @return string
     */
    function e($p_string): string
    {
        if ($p_string === null) {
            return "";
        }
        return htmlspecialchars("$p_string", ENT_QUOTES | ENT_HTML5);
    }
    
    /**
     * Make javascript for confirm message
     *
     * @param
     *            String Message in confirmation box
     * @param
     *            String Url url location to go when confirmed
     */
    function confirmJs(String $p_message,String $p_url):string
    {
        return "if(confirm(" . json_encode($p_message) . "))window.location=" . json_encode($p_url);
    }
    
    /**
     * Create tag object
     *
     * @param string $p_tag
     * @return Tag
     */
    function tag(string $p_tag):Tag
    {
        return new Tag($p_tag);
    }
    
    /**
     * Make a call to a js function
     * 
     * @param String $p_function  function name 
     * @param array $p_params     parameters
     * @return string             js call
     */
    function makeJsCall(String $p_function ,Array $p_params):string
    {
        $l_call="";
        foreach($p_params as $l_param){
            $l_call .= ($l_call?",":"").json_encode($l_param);   
        }
        return $p_function."(".$l_call.")";
    }
    
    /**
     * Produce <div> tag
     * 
     * @return Tag
     */
    function div():Tag
    {
        return $this->tag("div");
    }      
    
    function jsStart():void
    {
        ?><script type='text/javascript'><?php 
    }
    
    function jsEnd():void
    {
        ?></script><?php 
    }
}
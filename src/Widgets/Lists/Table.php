<?php
declare(strict_types=1);
namespace XMLView\Widgets\Lists;


use XMLView\Engine\Data\DataStore;
use XMLView\HtmlComponent;
use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;

/**
 * Displays table from some data.
 * Usages:
 * -Set data by __construct($p_data) $p_data must be iterable or an array.
 * -Set config by setConfig(data)
 * -Define get data=>this method converts item to row data
 * config:
 * [*name1*=>["type"=>*type*,"title"=>"title",*other config*
 * ,*name2*=>[
 * Types:
 * @text -static text (text is escaped)
 * @html - html text
 * @iconlink - Link with an icon
 * @link - text link
 * @iconlinkconfirm - Ion link with confirm message
 */
abstract class Table extends Widget{
    private $config=[];
    protected $title;
    protected $data;
    protected $custom=[];
    const TEXT="@text";
    const HTML="@html";
    const ICONLINK="@iconlink";
    const ICONLINKCONFIRM="@iconlinkconfirm";
    const LINK="@link";
    
    function setData(DynamicValue $p_data)
    {
        $this->data=$p_data;
    }
    
    
    function setConfigItem(string $p_name,string $p_field,$p_value):void
    {
        $this->config[$p_name][$p_field]=$p_value;
    }
    
    /**
     * Set the configuration of a column
     * 
     * @param string $p_name Name of the column
     * @param array $p_data configurations
     */
    function setConfigElement(string $p_name,Array $p_data):void
    {
        $this->config[$p_name]=$p_data;
    }
    
/**
 * Add the table configution 
 * 
 * @param array $p_config Associative array with Configuration of the table (keys are field names)
 */    
    function addConfig(array $p_config):void
    {
        $this->config=array_merge($this->config,$p_config);
    }
    
/**
 * Display the table header(titles)
 */
    private function displayTableHeader():void
    {
        $this->theme->base_Table->headerBegin();
        foreach($this->config as $l_info){
            $this->theme->base_Table->columnHeader($l_info["title"]);             
        }
        $this->theme->base_Table->headerEnd();
    }
    
    /**
     * Get row data van p_info.
     * Returns associate array with row data. Key name is same as in $this->config
     * When return NULL the row is ignore
     * 
     * @param unknown $p_info
     * @return NULL|Array
     */
    protected abstract function getData($p_info,DataStore $p_store);
    
    /**
     * This function is used for setting up the table
     */
    function setup()
    {
        
    }
    
    function printRow($p_config,$p_value,$p_name):void
    {
        ?><td class="table_cell"><?php 
            $l_type=$p_config["type"];
            switch($l_type){
                case "@text":
                    echo $this->theme->e($p_value);
                    break;
                    
                case "@html":
                    echo $p_value;
                    break;
                    
                case "@iconlink":
                    if($p_value != null){
                        $this->theme->base_Table->iconLink($p_value,$p_config["icon"]);                        
                    }
                    break;
                case "@iconlinkconfirm":
                    if($p_value != null){
                        $this->theme->iconConfirm($p_config["confirmmsg"],$p_value,$p_config["icon"]);
                    }                       
                    break;
                    
                case "@link":
                    $this->theme->base_Table->link($p_value[0],$p_value[1]);
                    break;
                    
                default:
                    if(isset($this->custom[$p_name])){
                        $l_object=$this->custom[$p_name];
                    } else {
                        $l_object=new $l_type($p_config);
                        $this->custom[$p_name]=$l_object;
                    }
                    $l_object->display($p_value);
              }
        ?></td><?php 
        
    }
    
    /**
     * Output the html of the table
     *  
     * {@inheritDoc}
     * @see \XMLView\HtmlComponent::display()
     */
    
    function displayContent(?DataStore $p_store=null):void
    {
        $this->setup();
        $this->theme->base_Table->tableHeader();
        if($this->title ){
            $l_title=$this->title->getValue($p_store);
            $this->theme->base_Table->tableTitle(count($this->config),$l_title);            
        }
        $this->displayTableHeader();
        $l_rows=$this->data->getValue($p_store);       
        foreach($l_rows as $l_row){            
            $l_data=$this->getData($l_row,$p_store);
            if($l_data===null){
                continue;
            }
            $this->theme->base_Table->rowHeader();            
            foreach($this->config as $l_name=>$l_config){
                   $this->printRow($l_config,$l_data[$l_name],$l_name);
            }
            $this->theme->base_Table->rowFooter();            
        }        
        $this->theme->base_Table->tableFooter();        
    }
}
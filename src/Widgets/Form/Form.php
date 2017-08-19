<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Form;

use Illuminate\Support\ViewErrorBag;
use App\Vc\Form\FormException;
use XMLView\Engine\Data\DataStore;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\MapData;
use XMLView\Widgets\Base\Widget;
use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Engine\Data\DataLayer;



/**
 * Display a input form 
 *
 */
class Form extends Widget
{
    private static $idCnt=0;
    protected $id=null;
    protected $title;
    protected $route;
    protected $routeParams;
    protected $url;
    protected $cancelUrl;
    protected $saveText;
    protected $cancelText;
    protected $data=null;
    protected $errors;
    private $elements=[];
    private $hidden=[];
    
    
    /**
     * Setup form
     * 
     * @param ViewErrorBag|null $p_errors Errors displayed in form (used after submit and return to form)
     */
    function __construct()
    {
        self::$idCnt++;
        $this->id="form_".self::$idCnt."_";
        parent::__construct();
    }
     
   
    function setData(DynamicValue $p_data)
    {
        $this->data=$p_data;
    }
    
    function getData()
    {
        return $this->data;
    }
    
    function setUrl(DynamicValue $p_url):void
    {
        $this->url=$p_url;
    }
    
    function getUrl():?DynamicValue
    {
        return $this->url;
    }
    
    /**
     * Add a hidden value 
     * @param string  $p_name   name of hidden value
     * @param unknown $p_valeu  value of the hidden element
     */
    function addHidden(string $p_name,$p_value){
        $this->hidden[$p_name]=$p_value;
    }
    
    /**
     * Get the JS used by form

     */
    function getJs(DataStore $p_store):array
    {
        return ["/js/form.js"];
    }
    
    /**
     * Add a form element to a form
     * 
     * @param HtmlComponent $p_component
     * @throws FormException
     * @return HtmlComponent
     */
    function add(HtmlComponent $p_component):HtmlComponent
    {
        if(!($p_component instanceof FormElement)){
            throw new FormException("Element is not a instance of FormElement");
        }
        if($p_component->getName()==""){
            throw new FormException(__("Form element of type ':type' has a empty name ",["type"=>get_class($p_component)]));
        }        
        $p_component->setId($this->elementId($p_component->getName()));
        $p_component->setRowId($this->elementRowId($p_component->getName()));
        $p_component->setName($p_component->getName());

        $this->elements[$p_component->getName()]=$p_component;
        
        return $p_component;
    }
        
     
    
     
    /**
     * Called before form is displayed
     * 
     * @return array Return data used in form
     */
    protected function preForm(?MapData $p_store):DataStore
    {
        $l_data=$this->data->getValue($p_store);
        foreach($l_data as $l_name=>&$l_value){
            $l_value=old($l_name,$l_value);
        }
        return new MapData($p_store,$l_data);        
    }
    
    /**
     * Get the dom ID of the element row.
     * 
     * @param unknown $p_name element name
     * @return string
     */
    private function elementRowId(string $p_name):string
    {
        return $this->id."r_".$p_name;
    }
    
    /**
     * Get the dom ID of a element.
     *
     * @param unknown $p_name element name
     * @return string
     */
    private function elementId(string $p_name):string
    {
        return $this->id.$p_name;
    }
    
    
    /**
     * Setup elements here (user addElement or addElements)
     */
    function setup(){
        
    }    
    
    function generateConditionJs()
    {
        ?>l_form.checkConditions=function(){
        	var form=this.form;
        <?php
        foreach($this->elements as $l_name=>$l_element){
            if($l_element->getCondition()){
                ?>this.showElement(<?=json_encode($l_name)?>,<?=$l_element->getCondition()?>);
                <?php 
            }       
        }
        ?>};<?php
    }
    
    /**
     * Display form
     * {@inheritDoc}
     * @see \XMLView\HtmlComponent::display()
     */
    function displayContent(?DataStore $p_store=null)
    {        
        
        /**
         * This code is needed for getting the error data to the 
         */
        
       
        $this->setup();
        $this->errors=$this->getPage()->getErrors();
        if($this->errors){
            foreach ($this->elements as $l_element) {
                
                if ($this->errors->has($l_element->getName())) {
                    $l_error = $this->errors->first($l_element->getName());
                    $l_element->setError($l_error);
                }
            }
        }
        $l_formData=$this->preForm($p_store);
        $this->theme->base_Form->formHeader($this->id,$this->url?$this->url->getValue($l_formData):"");
        foreach($this->hidden as $l_name=>$l_value){
            $this->theme->base_Form->hidden($l_name,$l_formData->getValue($l_name));
        }
        $this->theme->base_Form->header($this->title);
        foreach($this->elements as $l_name=>$l_element){    
            $l_element->display($l_formData);
        }
        $this->theme->base_Form->submitHeader($this->saveText?$this->saveText:__("Save"));        
        if($this->cancelUrl){
            $l_js="window.location=".json_encode($this->cancelUrl);
            $this->theme->base_Form->submitCancelButton($this->cancelText?$this->cancelText:__("Cancel"),$l_js);
        }

        $this->theme->base_Form->submitFooter();
        $this->theme->base_Form->footer();
        $this->theme->base_Form->formFooter();
        
        $this->theme->jsStart();
        ?>
        var l_form=new form(<?=json_encode($this->id)?>);
        l_form.elementNames=<?=json_encode(array_keys($this->elements))?>;
        <?php 
        $this->generateConditionJs();
        ?>        l_form.setup();
        <?php 
        $this->theme->jsEnd();
    }
}
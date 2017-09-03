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
use XMLView\Base\HtmlClass;
use XMLView\Engine\Data\DynamicStaticValue;



/**
 * Display a input form 
 *
 */
class Form extends Widget
{
    private static $idCnt=0;
    protected $id=null;
    /**
     * Title displayed on top of the form
     * @var DynamicValue
     */
    protected $title;
   
    /**
     * Data is submitted to this url
     * 
     * @var DynamicValue
     */
    protected $url;
    /**
     * URL used when the cancel button is pressed
     * @var DynamicValue
     */
    protected $cancelUrl;
    protected $saveText;
    /**
     * Text on the cancel button
     * 
     * @var DynamicValue
     */
    protected $cancelText;
    
    protected $errors;
    private $elements=[];
    private $hidden=[];
    
    
    /**
     * Setup  the form.
     * 
     * @param ViewErrorBag|null $p_errors Errors displayed in form (used after submit and return to form)
     */
    function __construct()
    {
        self::$idCnt++;
        $this->id="form_".self::$idCnt."_";
        parent::__construct();
        $this->setClassName(new DynamicStaticValue(HtmlClass::FORM));
    }
     
   
    /**
     * Set the submit URL 
     * 
     * @param DynamicValue $p_url Submit URL wrapped in a DynamicValue
     */
    function setUrl(DynamicValue $p_url):void
    {
        $this->url=$p_url;
    }
    
    /**
     * Get the submit url 
     * @return DynamicValue|NULL Submit url wrapped in dynamic value 
     */
    function getUrl():?DynamicValue
    {
        return $this->url;
    }
    
    /**
     * When this property is set and the url is not null a cancel button 
     * is dsplayed. When this button is pressed, the cancelURL page is loaded 
     * @param DynamicValue $p_url
     */
    function setCancelUrl(DynamicValue $p_url)
    {
        $this->cancelUrl=$p_url;
    }
    
    /**
     * Get the cancel url.
     * 
     * @return DynamicValue|NULL
     */
    function getCancelUrl():?DynamicValue
    {
       return $this->cancelUrl; 
    }
    
    
    function setCancelText(DynamicValue $p_cancelText)
    {
        $this->cancelText=$p_cancelText;
    }
    function getCancelText():?DynamicValue
    {
        return $this->cancelText;
    }
    /**
     * Set the title that is displayed above the form
     * 
     * @param DynamicValue $p_title String wrapped in a DynamicValue
     */
    function setTitle(DynamicValue $p_title):void
    {
        $this->title=$p_title;
    }
    
    /**
     * Get title that is displayed above the form
     * 
     * @return DynamicValue  Title
     */
    function getTitle():?DynamicValue
    {
        return $this->title;
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
     * Get the JS urls used by form
     */
    function getJs(DataStore $p_store):array
    {
        return ["/js/form.js"];
    }
    
    /**
     * Add a form element to the form
     * 
     * @param HtmlComponent $p_component  Element to add to the form 
     * @throws FormException              When a invalid element is added tot the form or when the name of the form is empty
     * @return HtmlComponent              Same as $p_component
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
    protected function preForm(?DataStore $p_store):DataStore
    {       
        
        $l_newValues=[];
        foreach($this->elements as $l_name=>&$l_element){
            if($l_element->hasData()){
                $l_value=$p_store->getValue($l_name);
                $l_newValue=xmlview_old($l_name,$l_value);
                if($l_newValue != $l_value ){
                    $l_newValues[$l_name]=$l_newValue;
                }
            }
        }
        if($l_newValues){
            $l_data=new MapData($p_store,$l_newValues);
        } else {
            $l_data=$p_store;
        }
        return $l_data;        
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
      */
    function displayContent(?DataStore $p_store=null)
    {        
        
        /**
         * This next code is needed for getting the error data to the form
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
        $this->theme->base_Form->formHeader($this->getBlockClass($p_store),$this->id,$this->url?$this->url->getValue($l_formData):"");
        foreach($this->hidden as $l_name=>$l_value){
            $this->theme->base_Form->hidden($l_name,$l_formData->getValue($l_name));
        }
        $l_title=$this->getAttValue("title", $p_store,"string",false);
        $this->theme->base_Form->header($l_title);
        foreach($this->elements as $l_name=>$l_element){    
            $l_element->display($l_formData);
        }
        $this->theme->base_Form->submitHeader($this->saveText?$this->saveText:__("Save"));
        $l_cancelUrl=$this->getAttValue("cancelUrl", $p_store,"string",false);
        if($l_cancelUrl){
            $l_cancelText=$this->getAttValue("cancelText", $p_store,"string",false);
            $l_js="window.location=".json_encode($l_cancelUrl);
            $this->theme->base_Form->submitCancelButton($l_cancelText?$$l_cancelText:__("Cancel"),$l_js);
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
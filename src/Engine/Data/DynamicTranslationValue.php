<?php 
declare(strict_types=1);
namespace XMLView\Engine\Data;

/**
 * This object represents a dynamic translateable string
 * A string 'some ${vara} string ${varb}" is first 
 * translated to "some :vara string :varb'  and a array [vara,varb].
 * 
 * In get value this array is used for getting the data used in the trasnlatabltext
 * 
 */class DynamicTranslationValue implements DynamicValue
{
        /**
         * Translatable text.
         *  
         * @var string
         */
    
        private $text;
        
        /**
         * Variables used in texts
         * @var array
         */
        private $variables;
        
        function __construct(string $p_text,array $p_variables)
        {
            $this->text=$p_text;
            $this->variables=$p_variables;
        }
        /**
         * Get the translatable text. 
         */
        function getText():string
        {
            return $this->text;
        }
        /**
         * Get the variables used in the translatable text.
         */
        function getVariables():array
        {
            return $this->variables;            
        }
       
        
        
        /**
         * In the routine first the value of the variables is retrieved
         * and next the string is translated.
         *  
         * @param DataStore $p_store Data used in the transaltion
         * @return DynamicValue
         */
        function getValue(DataStore $p_store)
        {
            $l_data=[];
            foreach($this->variables as $l_variable){
                $l_data[$l_variable]=$p_store->getValue($l_variable);                
            }
            return __($this->text,$l_data);
        }
}
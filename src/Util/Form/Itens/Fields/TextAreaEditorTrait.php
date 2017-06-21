<?php

namespace BW\Util\Form\Itens\Fields;

use Exception;
use cebe\markdown\GithubMarkdown as Markdown;

trait TextAreaEditorTrait
{
	//
	protected $textarea_parameters = [];
	protected static $textarea_parameters_default = [
		'type' => 'simple-text'
	];

	//
	private function isKeyTextAreaEditorTrait($key){
		if(in_array($key, static::$textarea)){
			return true;
		}

		return false;
	}

	//
	public function setParametersTextAreaEditorTrait($key, $value)
	{
		$this->textarea_parameters[$key] = $value;
	}

    //
    public function getSourceTextAreaEditorTrait($key)
    {
        if($this->isKeyTextAreaEditorTrait($key)){
            $regex  = '/^---int-textarea-parameters---\r\n';
            $regex .= '(.*)\r\n';
            $regex .= '---end-textarea-parameters---\r\n(.*)$/s';

            //
            preg_match($regex, $this->getAttribute($key), $matches, PREG_OFFSET_CAPTURE, 0);
            if(count($matches) == 3){

                // set parameters
                parse_str($matches[1][0], $parameters);
                $this->setParametersTextAreaEditorTrait($key, 
                    array_merge(static::$textarea_parameters_default, $parameters)
                );

                // get source
                return $matches[2][0];
            }
            
            //
            $this->setParametersTextAreaEditorTrait($key, static::$textarea_parameters_default); 
        }

        //
        return $this->getAttribute($key);
    }

	//
	public function getParametersTextAreaEditorTrait($key)
	{
		if($this->isKeyTextAreaEditorTrait($key)){
			if(array_key_exists($key, $this->textarea_parameters)){
				return $this->textarea_parameters[$key];
			}else{
				$this->__getTextAreaEditorTrait($key);
				$this->getParametersTextAreaEditorTrait($key);
			}

			return static::$textarea_parameters_default;
		}

		return null;
	}

    // register magic method __get
    public function __getTextAreaEditorTrait($key)
    {
    	if($this->isKeyTextAreaEditorTrait($key)){
            $source = $this->getSourceTextAreaEditorTrait($key);
            $params = $this->getParametersTextAreaEditorTrait($key);

            // make markdown
            if($params['type'] == 'markdown'){
                $parser = new Markdown();
                $parser->html5 = true;
                $parser->enableNewlines = true;
                
                //
                return $parser->parse($source);
            }

            //
            return $source;
    	}
         
        //   
        return self::$MAGIC_METHOD_NO_RETURN;
    }

    //
    public static function onSaveModelWithTextAreaEditorTrait($model){

    	// foreach all textarea for model
		foreach (static::$textarea as $key) {
			
	    	// check exists request type
	    	if(!is_null($type = request($key . '_type'))){
	    		$content  = "---int-textarea-parameters---\r\n";
	    		$content .= http_build_query(array_merge(static::$textarea_parameters_default, [
	    			'type' => $type
	    		])) . "\r\n";
	    		$content .= "---end-textarea-parameters---\r\n";
	    		$content .= $model->getAttribute($key);

	    		//
	    		$model->setAttribute($key, $content);
	    	}
		}
    }

    // register magic method boot (laravel)
    public static function bootTextAreaEditorTrait()
    {
    	if(!isset(static::$textarea) || !is_array(static::$textarea) || !count(static::$textarea) || 
    	   !in_array("BW\Traits\MagicMethodTrait", class_uses_recursive(get_called_class()))){

    	   	// Show Exception
    		throw new Exception("Para usar TextAreaEditorTrait, adicione no model: " . get_called_class() . "

    			// add trait
    			use BW\Traits\MagicMethodTrait, ...
    			
    			// add textarea list
    			protected static \$textarea = ['text1', 'text2'];
    		");
    	}

        // on create
        static::creating(function ($model) {
        	static::onSaveModelWithTextAreaEditorTrait($model);
        });
    
    	// on update
        static::updating(function($model){
        	static::onSaveModelWithTextAreaEditorTrait($model);
        });
    }

}

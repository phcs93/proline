<?php

abstract class Model {

	public function __construct($data){
		foreach($data as $key => $val){
			$this->$key = $val;
		}
	}

	public function getPK() {
		return array_shift(get_object_vars($this));
	}
    
	public function getHtmlData(){
    	$htmlDataString = "";
        foreach(get_class_methods(get_called_class()) as $method){
        	if (substr($method, 0, 3) == "get" && $method != "getHtmlData" && $method != "getPK"){
        		$ref = new ReflectionMethod($this, $method);
        		if (sizeOf($ref->getParameters()) == 0){
	        		$field = strtolower(substr($method, 3));
	        		$value = $this->$method();
	        		if (is_object($value)){
	        			if (get_class($value) != "Doctrine\ORM\PersistentCollection"){
	        				$field = "id$field";
		        			$pkGetter = "get" . $field;
		        			$value = $value->$pkGetter();
		        			$data = "data-$field=\"" . $value . "\" ";
		        			$htmlDataString .= $data;
	        			}
	        		}else{
	        			$data = "data-$field=\"" . $value . "\" ";
		        		$htmlDataString .= $data;
	        		}
    			}
        	}
        }
        return $htmlDataString . " data-crud=" . get_called_class() . " data-string=" . $this;
    }

	public static function findAll(){
		$objs = $GLOBALS['orm']->getRepository(get_called_class())->findAll();
		return orderObjs($objs);
	}

	public static function find($id) {
		return $GLOBALS['orm']->find(get_called_class(), $id);
	}
	
	public static function findBy($criteria) {
		return $GLOBALS['orm']->getRepository(get_called_class())->findBy($criteria);
	}

}
<?php

namespace BW\Util;

abstract class Assets {


	//
	static $config = NULL;


	//
	static public function getConfig(){

		if(is_null(SELF::$config)){
			SELF::$config = new Config();
		}

		return SELF::$config;
	}


	//
	static public function register($name, $path){

		//
		SELF::getConfig()->set($name, [
			'path' => $path,
		]);

	}


	//
	static public function dump(){
		var_dump(SELF::getConfig()->getAll());
	}

}

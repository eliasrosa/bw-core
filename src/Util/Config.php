<?php

namespace BW\Util;

use Config as AppConfig;

abstract class Config {

	//
	static public function register($key, $config_path){

		// verifica se existe configurações customizada
		$custon = AppConfig::get($key, []);

		//
		$path = explode('.', $key);
		if(count($path) === 1){
			$file_path = $config_path . DIRECTORY_SEPARATOR . $key . '.php';
		}else{
			$path[0] = $config_path;
			$file_path = join(DIRECTORY_SEPARATOR, $path) . '.php';
		}

		// carrega as configurações padrão, mesclando com as customizadas
		\Config::set($key, array_merge(require $file_path, $custon));
	}
}

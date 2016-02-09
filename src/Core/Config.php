<?php

namespace BW\Core;

abstract class Config
{
	static public function register($key, $config_path){

		// verifica se existe configurações
		$config = \Config::get($key, []);

		//
		if(is_file($config_path)){
			$file_path = $config_path;

		}elseif(strpos($key, '.') === false){
			$file_path = $config_path . '/' . $key . '.php';

		}else{
			$path = explode('.', $key);
			$path[0] = $config_path;
			$file_path = join('/', $path) . '.php';
		}

		// carrega as configurações padrões, mesclando com as antigas
		\Config::set($key, array_merge(require $file_path, $config));
	}
}

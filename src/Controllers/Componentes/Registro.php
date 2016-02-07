<?php

namespace BW\Core\Componentes;

use Config;
use BW\Core\Componentes\Componente;

abstract class Registro {

	//
	static public function add(Componente $componente) {

		//
		$componentes = SELF::getAll();
		$namespace = $componente->getNamespace();
		$componentes[$namespace] = $componente;

		//
		Config::set('bw.com', $componentes);
	}

	//
	static public function get($namespace) {
		$componentes = SELF::getAll();

		if(array_key_exists($namespace, $componentes)){
			return $componentes[$namespace];
		}

		return false;
	}

	//
	static public function getAll(){

		if(Config::has('bw.com')){
			return \Config::get('bw.com');
		}

		return [];
	}

}

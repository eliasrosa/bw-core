<?php

namespace BW\Controllers\Componentes;

use File;
use Config;
use BW\Util\Assets\Assets;
use Illuminate\Routing\Router;
use BW\Controllers\Componentes\Router as ComponenteRouter;


class Componente
{

	//
	protected $name = NULL;
	protected $path = NULL;
	protected $config_key = 'bw.com.';


	//
	public function __construct($name, $path) {

		$this->name = $name;
		$this->path = $path;

		//
        $this->mergeConfigFrom();

        //
        $this->configAssets();

	}


	public function mergeConfigFrom(){

		$key = $this->config_key . $this->name;

		$path = config_path(str_replace('.', '/', $this->config_key) . $this->name . '.php');

		//
		$config = Config::get($key, []);
		Config::set($key, array_merge(require $this->path . '/config.php', $config));

		//
		if(File::exists($path)){
			$config = Config::get($key, []);
			Config::set($key, array_merge(require $path, $config));
		}

		//
		Config::set($key . '.path', $this->path);
		Config::set($key . '.name', $this->name);
	}


	//
	static public function getConfig($key, $default = NULL){
		$var = $this->config_key . '.' . $key;
		return \Config::get($var, $default);
	}


	//
	public function setMap(Router $router){
        $r = new ComponenteRouter($this, $router);
        $r->map();
	}


	//
	public function configAssets()
	{
		$prefix = '/assets/' . $this->name;
		$path = $this->path . '/Assets';

        Assets::register($this->name, $path, $prefix);
	}

}

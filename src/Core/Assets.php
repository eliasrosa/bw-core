<?php

namespace BW\Core;

abstract class Assets
{
	static public function register($prefix, $path, $middleware = 'auth')
	{
		if(SELF::get($prefix) !== false){
			return false;
		}

		$key = 'bw.util.assets.repositories';
		$config = \Config::get($key, []);

		$config[] = [
			'prefix' => $prefix,
			'path' => $path,
			'middleware' => $middleware,
		];

		\Config::set($key, $config);
	}

	static public function getAll($middleware = 'all')
	{

		$all = \Config::get('bw.util.assets.repositories', []);

		if($middleware == 'all'){
			return $all;
		}

		$list = [];
		foreach ($all as $i) {
			if($i['middleware'] == $middleware){
				$list[] = $i;
			}
		}

		return $list;
	}

	static public function get($prefix)
	{
		foreach (SELF::getAll() as $i) {
			if($i['prefix'] == $prefix){
				return $i['path'];
			}
		}

		return false;
	}
}

<?php

namespace BW\Core;

abstract class Assets
{
	static public function register($prefix, $path)
	{
		if(SELF::get($prefix) !== false){
			return false;
		}

		$key = 'bw.util.assets.repositories';
		$config = \Config::get($key, []);

		$config[] = [
			'prefix' => $prefix,
			'path' => $path,
		];

		\Config::set($key, $config);
	}

	static public function getAll()
	{
		return \Config::get('bw.util.assets.repositories', []);
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

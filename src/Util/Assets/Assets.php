<?php

namespace BW\Util\Assets;

use Config;
use Illuminate\Routing\Controller as Controller;

class Assets extends Controller
{

    static $config = 'bw.util.assets';

	static public function register($name, $path, $prefix)
	{
		Config::set(static::$config . '.repositories.' . $name, [
			'prefix' => $prefix,
			'path' => $path,
		]);

	}

	static public function getAll()
	{
		return Config::get(static::$config . '.repositories', []);
	}
}

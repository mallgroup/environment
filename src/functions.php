<?php

declare(strict_types=1);

use Mallgroup\Environment;

if (!function_exists('env')) {
	function env(string $env, string $default = '', string $cast = Environment::STRING): float|bool|int|string
	{
		return (new Environment($env, $default))->get($cast);
	}
}

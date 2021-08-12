<?php declare(strict_types=1);

use Mallgroup\Environment as Env;
use function Mallgroup\setenv;
use Tester\Assert;

require 'bootstrap.php';
require 'getenv.php';

setenv('BOOL-1', 'true');
setenv('BOOL-2', '1');
setenv('BOOL-3', 'value');
setenv('BOOL-4', 'false');
setenv('BOOL-5', '0');

Assert::type('bool', Env::bool('BOOL-1'));
Assert::type('bool', Env::bool('BOOL-2'));
Assert::type('bool', Env::bool('BOOL-3'));
Assert::type('bool', Env::bool('BOOL-4'));
Assert::type('bool', Env::bool('BOOL-5'));
Assert::type('bool', Env::bool('BOOL-6'));

Assert::equal(true, Env::bool('BOOL-1'));
Assert::equal(true, Env::bool('BOOL-2'));
Assert::equal(true, Env::bool('BOOL-3'));
Assert::equal(false, Env::bool('BOOL-4'));
Assert::equal(false, Env::bool('BOOL-5'));
Assert::equal(false, Env::bool('BOOL-5'));

Assert::equal(true, (new Env('BOOL-1', 'false'))->get(Env::BOOL));
Assert::equal(true, (new Env('BOOL-1', '0'))->get(Env::BOOL));
Assert::equal(true, (new Env('BOOL-X', '1'))->get(Env::BOOL));
Assert::equal(true, (new Env('BOOL-X', 'true'))->get(Env::BOOL));
Assert::equal(false, (new Env('BOOL-X', 'false'))->get(Env::BOOL));
Assert::equal(false, (new Env('BOOL-X', '0'))->get(Env::BOOL));
Assert::equal(false, (new Env('BOOL-X', ''))->get(Env::BOOL));

Assert::equal(true, env('BOOL-1', 'false', Env::BOOL));
Assert::equal(true, env('BOOL-1', '0', Env::BOOL));
Assert::equal(true, env('BOOL-X', '1', Env::BOOL));
Assert::equal(true, env('BOOL-X', 'true', Env::BOOL));
Assert::equal(false, env('BOOL-X', 'false', Env::BOOL));
Assert::equal(false, env('BOOL-X', '0', Env::BOOL));
Assert::equal(false, env('BOOL-X', '', Env::BOOL));
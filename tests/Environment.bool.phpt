<?php declare(strict_types=1);

require 'bootstrap.php';
require 'getenv.php';

use Mallgroup\Environment;
use function Mallgroup\setenv;
use Tester\Assert;

setenv('BOOL-1', 'true');
setenv('BOOL-2', '1');
setenv('BOOL-3', 'value');
setenv('BOOL-4', 'false');
setenv('BOOL-5', '0');

Assert::type('bool', Environment::bool('BOOL-1'));
Assert::type('bool', Environment::bool('BOOL-2'));
Assert::type('bool', Environment::bool('BOOL-3'));
Assert::type('bool', Environment::bool('BOOL-4'));
Assert::type('bool', Environment::bool('BOOL-5'));
Assert::type('bool', Environment::bool('BOOL-6'));

Assert::equal(true, Environment::bool('BOOL-1'));
Assert::equal(true, Environment::bool('BOOL-2'));
Assert::equal(true, Environment::bool('BOOL-3'));
Assert::equal(false, Environment::bool('BOOL-4'));
Assert::equal(false, Environment::bool('BOOL-5'));
Assert::equal(false, Environment::bool('BOOL-5'));

Assert::equal(true, (new Environment('BOOL-1', 'false'))->get(Environment::BOOL));
Assert::equal(true, (new Environment('BOOL-1', '0'))->get(Environment::BOOL));
Assert::equal(true, (new Environment('BOOL-X', '1'))->get(Environment::BOOL));
Assert::equal(true, (new Environment('BOOL-X', 'true'))->get(Environment::BOOL));
Assert::equal(false, (new Environment('BOOL-X', 'false'))->get(Environment::BOOL));
Assert::equal(false, (new Environment('BOOL-X', '0'))->get(Environment::BOOL));
Assert::equal(false, (new Environment('BOOL-X', ''))->get(Environment::BOOL));

Assert::equal(true, env('BOOL-1', 'false', Environment::BOOL));
Assert::equal(true, env('BOOL-1', '0', Environment::BOOL));
Assert::equal(true, env('BOOL-X', '1', Environment::BOOL));
Assert::equal(true, env('BOOL-X', 'true', Environment::BOOL));
Assert::equal(false, env('BOOL-X', 'false', Environment::BOOL));
Assert::equal(false, env('BOOL-X', '0', Environment::BOOL));
Assert::equal(false, env('BOOL-X', '', Environment::BOOL));

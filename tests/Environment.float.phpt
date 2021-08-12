<?php declare(strict_types=1);

use Mallgroup\Environment as Env;
use function Mallgroup\setenv;
use Tester\Assert;

require 'bootstrap.php';
require 'getenv.php';

setenv('FLOAT-1', '1');
setenv('FLOAT-2', '1,1');
setenv('FLOAT-3', '1.1');
setenv('FLOAT-4', '0');

Assert::type('float', Env::float('FLOAT-1'));
Assert::type('float', Env::float('FLOAT-2'));
Assert::type('float', Env::float('FLOAT-3'));
Assert::type('float', Env::float('FLOAT-4'));
Assert::type('float', Env::float('FLOAT-5'));

Assert::equal(1.0, Env::float('FLOAT-1'));
Assert::equal(1.0, Env::float('FLOAT-2'));
Assert::equal(1.1, Env::float('FLOAT-3'));
Assert::equal(0.0, Env::float('FLOAT-4'));
Assert::equal(0.0, Env::float('FLOAT-5'));

Assert::equal(1.0, (new Env('FLOAT-1', '1'))->get(Env::FLOAT));
Assert::equal(1.0, (new Env('FLOAT-2', '1,1'))->get(Env::FLOAT));
Assert::equal(1.1, (new Env('FLOAT-3', '1.1'))->get(Env::FLOAT));
Assert::equal(0.0, (new Env('FLOAT-X'))->get(Env::FLOAT));
Assert::equal(1.1, (new Env('FLOAT-X', '1.1'))->get(Env::FLOAT));

Assert::notEqual(1.1, (new Env('FLOAT-1'))->get(Env::FLOAT));
Assert::notEqual(1.1, (new Env('FLOAT-X', '1.0'))->get(Env::FLOAT));

Assert::equal(1.0, env('FLOAT-1', '1', Env::FLOAT));
Assert::equal(1.0, env('FLOAT-2', '1,1', Env::FLOAT));
Assert::equal(1.1, env('FLOAT-3', '1.1', Env::FLOAT));
Assert::equal(0.0, env('FLOAT-X', '0', Env::FLOAT));
Assert::equal(1.1, env('FLOAT-X', '1.1', Env::FLOAT));

<?php declare(strict_types=1);

use Mallgroup\Environment as Env;
use function Mallgroup\setenv;
use Tester\Assert;

require 'bootstrap.php';
require 'getenv.php';

setenv('INT-1', '1');
setenv('INT-2', '1,1');
setenv('INT-3', '1.1');
setenv('INT-4', '0');

Assert::type('int', Env::int('INT-1'));
Assert::type('int', Env::int('INT-2'));
Assert::type('int', Env::int('INT-3'));
Assert::type('int', Env::int('INT-4'));
Assert::type('int', Env::int('INT-5'));

Assert::equal(1, Env::int('INT-1'));
Assert::equal(1, Env::int('INT-2'));
Assert::equal(1, Env::int('INT-3'));
Assert::equal(0, Env::int('INT-4'));
Assert::equal(0, Env::int('INT-5'));

Assert::equal(1, (new Env('INT-1', '1'))->get(Env::INT));
Assert::equal(1, (new Env('INT-2', '1,1'))->get(Env::INT));
Assert::equal(1, (new Env('INT-3', '1.1'))->get(Env::INT));
Assert::equal(1, (new Env('INT-X', '1.1'))->get(Env::INT));
Assert::equal(0, (new Env('INT-X'))->get(Env::INT));

Assert::notEqual(1, (new Env('INT-X', '0'))->get(Env::INT));
Assert::notEqual(1, (new Env('INT-X', ''))->get(Env::INT));

Assert::equal(1, env('INT-1', '1', Env::INT));
Assert::equal(1, env('INT-2', '1,1', Env::INT));
Assert::equal(1, env('INT-3', '1.1', Env::INT));
Assert::equal(1, env('INT-X', '1.1', Env::INT));
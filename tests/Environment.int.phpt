<?php
declare(strict_types=1);

use Mallgroup\Environment;
use Tester\Assert;

use function Mallgroup\setenv;

require 'bootstrap.php';
require 'getenv.php';

setenv('INT-1', '1');
setenv('INT-2', '1,1');
setenv('INT-3', '1.1');
setenv('INT-4', '0');

Assert::type('int', Environment::int('INT-1'));
Assert::type('int', Environment::int('INT-2'));
Assert::type('int', Environment::int('INT-3'));
Assert::type('int', Environment::int('INT-4'));
Assert::type('int', Environment::int('INT-5'));

Assert::equal(1, Environment::int('INT-1'));
Assert::equal(1, Environment::int('INT-2'));
Assert::equal(1, Environment::int('INT-3'));
Assert::equal(0, Environment::int('INT-4'));
Assert::equal(0, Environment::int('INT-5'));

Assert::equal(1, (new Environment('INT-1', '1'))->get(Environment::INT));
Assert::equal(1, (new Environment('INT-2', '1,1'))->get(Environment::INT));
Assert::equal(1, (new Environment('INT-3', '1.1'))->get(Environment::INT));
Assert::equal(1, (new Environment('INT-X', '1.1'))->get(Environment::INT));
Assert::equal(0, (new Environment('INT-X'))->get(Environment::INT));

Assert::notEqual(1, (new Environment('INT-X', '0'))->get(Environment::INT));
Assert::notEqual(1, (new Environment('INT-X', ''))->get(Environment::INT));

Assert::equal(1, env('INT-1', '1', Environment::INT));
Assert::equal(1, env('INT-2', '1,1', Environment::INT));
Assert::equal(1, env('INT-3', '1.1', Environment::INT));
Assert::equal(1, env('INT-X', '1.1', Environment::INT));
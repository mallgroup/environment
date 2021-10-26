<?php
declare(strict_types=1);

use Mallgroup\Environment;
use Tester\Assert;

use function Mallgroup\setenv;

require 'bootstrap.php';
require 'getenv.php';

setenv('STRING-1', 'hello');
setenv('STRING-2', '1');
setenv('STRING-3', 'true');

Assert::type('string', Environment::string('STRING-1'));
Assert::type('string', Environment::string('STRING-2'));
Assert::type('string', Environment::string('STRING-3'));
Assert::type('string', Environment::string('STRING-4'));

Assert::equal('hello', Environment::string('STRING-1'));
Assert::equal('1', Environment::string('STRING-2'));
Assert::equal('true', Environment::string('STRING-3'));
Assert::equal('', Environment::string('STRING-4'));
Assert::equal('hello', Environment::string('STRING-4', 'hello'));

Assert::equal('hello', (new Environment('STRING-1'))->get(Environment::STRING));
Assert::equal('1', (new Environment('STRING-2'))->get(Environment::STRING));
Assert::equal('hello', (new Environment('STRING-X', 'hello'))->get(Environment::STRING));
Assert::equal('world', (new Environment('STRING-X', 'world'))->get(Environment::STRING));
Assert::equal('', (new Environment('STRING-X'))->get(Environment::STRING));

Assert::equal('hello', (string)(new Environment('STRING-1')));
Assert::equal('1', (string)(new Environment('STRING-2')));
Assert::equal('hello', (string)(new Environment('STRING-X', 'hello')));
Assert::equal('world', (string)(new Environment('STRING-X', 'world')));
Assert::equal('', (string)(new Environment('STRING-X')));

Assert::notEqual('', (new Environment('STRING-X', 'null'))->get(Environment::STRING));
Assert::notEqual('', (new Environment('STRING-X', 'false'))->get(Environment::STRING));

Assert::equal('hello', env('STRING-1'));
Assert::equal('1', env('STRING-2'));
Assert::equal('hello', env('STRING-X', 'hello'));
Assert::equal('world', env('STRING-X', 'world'));
Assert::equal('', env('STRING-X'));
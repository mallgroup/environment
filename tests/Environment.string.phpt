<?php declare(strict_types=1);

use Mallgroup\Environment as Env;
use function Mallgroup\setenv;
use Tester\Assert;

require 'bootstrap.php';
require 'getenv.php';

setenv('STRING-1', 'hello');
setenv('STRING-2', '1');
setenv('STRING-3', 'true');

Assert::type('string', Env::string('STRING-1'));
Assert::type('string', Env::string('STRING-2'));
Assert::type('string', Env::string('STRING-3'));
Assert::type('string', Env::string('STRING-4'));

Assert::equal('hello', Env::string('STRING-1'));
Assert::equal('1', Env::string('STRING-2'));
Assert::equal('true', Env::string('STRING-3'));
Assert::equal('', Env::string('STRING-4'));
Assert::equal('hello', Env::string('STRING-4', 'hello'));

Assert::equal('hello', (new Env('STRING-1'))->get(Env::STRING));
Assert::equal('1', (new Env('STRING-2'))->get(Env::STRING));
Assert::equal('hello', (new Env('STRING-X', 'hello'))->get(Env::STRING));
Assert::equal('world', (new Env('STRING-X', 'world'))->get(Env::STRING));
Assert::equal('', (new Env('STRING-X'))->get(Env::STRING));

Assert::equal('hello', (string)(new Env('STRING-1')));
Assert::equal('1', (string)(new Env('STRING-2')));
Assert::equal('hello', (string)(new Env('STRING-X', 'hello')));
Assert::equal('world', (string)(new Env('STRING-X', 'world')));
Assert::equal('', (string)(new Env('STRING-X')));

Assert::notEqual('', (new Env('STRING-X', 'null'))->get(Env::STRING));
Assert::notEqual('', (new Env('STRING-X', 'false'))->get(Env::STRING));

Assert::equal('hello', env('STRING-1'));
Assert::equal('1', env('STRING-2'));
Assert::equal('hello', env('STRING-X', 'hello'));
Assert::equal('world', env('STRING-X', 'world'));
Assert::equal('', env('STRING-X'));
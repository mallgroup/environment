<?php declare(strict_types=1);

use Mallgroup\Environment;
use function Mallgroup\setenv;
use Tester\Assert;

require 'bootstrap.php';
require 'getenv.php';

setenv('PREFIX_VAR_1', 'hello');

Environment::setPrefix('prefix');
Assert::equal('hello', env('VAR_1'));
Assert::equal('hello', Environment::string('VAR_1'));

Environment::setPrefix('prefix_');
Assert::equal('hello', env('VAR_1'));
Assert::equal('hello', Environment::string('VAR_1'));

Environment::setPrefix('prefix_var');
Assert::equal('hello', env('1'));
Assert::equal('hello', Environment::string('1'));

Environment::setPrefix('prefix_var_');
Assert::equal('hello', env('1'));
Assert::equal('hello', Environment::string('1'));

<?php
declare(strict_types=1);

use Mallgroup\Environment;
use Tester\Assert;

use function Mallgroup\setenv;

require 'bootstrap.php';
require 'getenv.php';

setenv('ARRAY-VALUE', 'hello|world');
setenv('ARRAY-VALUE2', 'hello,world');
setenv('ARRAY-VALUE3', 'hello|world||');
setenv('ARRAY-VALUE4', '1|2|0|');

Assert::type('array', Environment::array('ARRAY-VALUE'));
Assert::type('array', Environment::array('ARRAY-VALUE'));
Assert::type('array', Environment::array('ARRAY-VALUE2'));
Assert::type('array', Environment::array('ARRAY-VALUE', ','));
Assert::type('array', Environment::array('ARRAY-VALUE2', ','));
Assert::type('array', Environment::array('ARRAY-VALUE3', '|'));

Assert::same(['hello', 'world'], Environment::array('ARRAY-VALUE'));
Assert::same(['hello|world'], Environment::array('ARRAY-VALUE', ','));
Assert::same(['hello,world'], Environment::array('ARRAY-VALUE2'));
Assert::same(['hello', 'world'], Environment::array('ARRAY-VALUE3'));

Assert::same(['hello', 'world'], (new Environment('ARRAY-VALUE'))->toArray());
Assert::same(['hello|world'], (new Environment('ARRAY-VALUE', ','))->toArray());
Assert::same(['hello,world'], (new Environment('ARRAY-VALUE2'))->toArray());
Assert::same(['hello', 'world'], (new Environment('ARRAY-VALUE3'))->toArray());

Assert::same([1, 2, 0], Environment::array('ARRAY-VALUE4', cast: Environment::INTEGER));
Assert::same([1, 2, 0], Environment::array('ARRAY-VALUE4', cast: Environment::INT));
Assert::same([1, 2, 0], (new Environment('ARRAY-VALUE4'))->toArray(Environment::INTEGER));
Assert::same([1, 2, 0], (new Environment('ARRAY-VALUE4'))->toArray(Environment::INT));

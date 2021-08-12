<?php declare(strict_types=1);

function env(string $value): string {
    return $value;
}

use Tester\Assert;

require 'bootstrap.php';

Assert::equal('input', env('input'));
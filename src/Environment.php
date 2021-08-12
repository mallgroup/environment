<?php

declare(strict_types=1);

namespace Mallgroup;

class Environment
{
    public const STRING = 'string';
    public const BOOL = 'bool';
    public const INT = 'int';
    public const FLOAT = 'float';

    public function __construct(
        private string $name,
        private string $default = ''
    ) {
    }

    public static function bool(string $name, bool $default = false): bool
    {
        return (bool)(self::castIt(self::env($name), self::BOOL) ?? $default);
    }

    private static function castIt(?string $value, string $cast): null|string|bool|int|float
    {
        return ($value !== null) ? match ($cast) {
            self::BOOL => !($value === 'false' || !$value),
            self::INT => (int)$value,
            self::FLOAT => (float)$value,
            default => $value,
        } : null;
    }

    private static function env(string $name): ?string
    {
        $env = getenv($name);
        return (false === $env) ? null : $env;
    }

    public static function int(string $name, int $default = 0): int
    {
        return (int)(self::env($name) ?? $default);
    }

    public static function float(string $name, float $default = 0): float
    {
        return (float)(self::castIt(self::env($name), self::FLOAT) ?? $default);
    }

    public static function string(string $name, string $default = ''): string
    {
        return self::env($name) ?? $default;
    }

    public function __toString(): string
    {
        return self::env($this->name) ?? $this->default;
    }

    public function get(string $cast = self::STRING): string|bool|int|float
    {
        return self::castIt(self::env($this->name) ?? $this->default, $cast) ?? '';
    }
}
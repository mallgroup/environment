<?php
declare(strict_types=1);

namespace Mallgroup;

use function array_filter;
use function array_map;
use function explode;
use function rtrim;
use function strtolower;
use function strtoupper;

class Environment
{
	public const STRING = 'string';
	public const BOOL = 'bool';
	public const BOOLEAN = 'boolean';
	public const INT = 'int';
	public const INTEGER = 'integer';
	public const FLOAT = 'float';
	protected const DELIMITER = '|';
	protected static string $prefix = '';

	public function __construct(
		private string $name,
		private string $default = ''
	) {
	}

	public static function setPrefix(string $prefix = ''): void
	{
		self::$prefix = $prefix ? strtoupper(rtrim($prefix, '_')) . '_' : '';
	}

	public static function bool(string $name, bool $default = false): bool
	{
		return (bool)(self::castIt(self::env($name), self::BOOL) ?? $default);
	}

	private static function castIt(?string $value, string $cast): null|string|bool|int|float
	{
		return ($value !== null) ? match ($cast) {
			self::BOOL, self::BOOLEAN => !($value === 'false' || !$value),
			self::INT, self::INTEGER => (int)$value,
			self::FLOAT => (float)$value,
			default => $value,
		} : null;
	}

	private static function env(string $name): ?string
	{
		$env = getenv(self::$prefix . $name);
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

	public function __toString(): string
	{
		return self::env($this->name) ?? $this->default;
	}

	public function get(string $cast = self::STRING): string|bool|int|float
	{
		return self::castIt(self::env($this->name) ?? $this->default, strtolower($cast)) ?? '';
	}

	/**
	 * @param string $cast
	 * @return bool[]|float[]|int[]|string[]
	 */
	public function toArray(string $cast = self::STRING): array
	{
		return self::array($this->name, $this->default ?: self::DELIMITER, $cast);
	}

	/**
	 * @param string $name
	 * @param non-empty-string $separator
	 * @param string $cast
	 * @return string[]|int[]|float[]|bool[]
	 */
	public static function array(string $name, string $separator = self::DELIMITER, string $cast = self::STRING): array
	{
		return
			array_filter(
				array_map(
					static fn($item) => self::castIt($item, $cast),
					array_filter(
						explode($separator, self::string($name)),
						static fn($item) => $item !== ''
					)
				),
				static fn($item) => $item !== null
			);
	}

	public static function string(string $name, string $default = ''): string
	{
		return self::env($name) ?? $default;
	}
}
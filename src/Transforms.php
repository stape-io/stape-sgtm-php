<?php

namespace Stape\Sgtm;

class Transforms
{
	public static function base64(string $str): string
	{
		return \base64_encode($str);
	}

	public static function trim(string $str): string
	{
		return \trim($str);
	}

	public static function sha256base64(string $str): string
	{
		return self::sha256hex(self::base64($str));
	}

	public static function sha256hex(string $str): string
	{
		return \hash('sha256', self::toLowerCase($str));
	}

	public static function md5(string $str): string
	{
		return \md5(self::toLowerCase($str));
	}

	public static function toLowerCase(string $str): string
	{
		return \strtolower($str);
	}
}
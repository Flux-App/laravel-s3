<?php namespace Fuzz\LaravelS3\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Config;

class S3Manager extends Facade
{
	/**
	 * Where we find assets configuration.
	 * @var string
	 */
	const ASSETS_CONFIG = 'assets.';

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 *         Name of the component
	 */
	protected static function getFacadeAccessor()
	{
		return 's3manager';
	}

	/**
	 * Shim asset config keys to sizes arrays.
	 */
	public static function uploadImage($file_var = 'upload', $directory = null, $sizes = null)
	{
		return self::forwardImageUploadCall(__FUNCTION__, func_get_args());
	}

	/**
	 * Shim asset config keys to sizes arrays.
	 */
	public static function uploadImageFile($file_var = 'upload', $directory = null, $sizes = null)
	{
		return self::forwardImageUploadCall(__FUNCTION__, func_get_args());
	}

	/**
	 * Shim asset config keys to sizes arrays.
	 */
	public static function uploadImageFileObject($file_var = 'upload', $directory = null, $sizes = null)
	{
		return self::forwardImageUploadCall(__FUNCTION__, func_get_args());
	}

	/**
	 * Shim asset config keys to sizes array.
	 */
	public static function uploadImageBlob()
	{
		return self::forwardImageUploadCall(__FUNCTION__, func_get_args());
	}

	/**
	 * Shim asset config keys to sizes array in forwarded calls.
	 */
	private static function forwardImageUploadCall($method, $arguments, $size_index = 2)
	{
		$arguments[$size_index] = Config::get(self::ASSETS_CONFIG . $arguments[$size_index]);

		return call_user_func_array(array(self::resolveFacadeInstance('s3manager'), $method), $arguments);
	}
}

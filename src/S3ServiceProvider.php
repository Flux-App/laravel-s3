<?php namespace Fuzz\LaravelS3;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Fuzz\S3\Manager;

class S3ServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		App::bind('s3manager', function() {
			$s3_config = Config::get('aws');
			return new Manager($s3_config['key'], $s3_config['secret'], $s3_config['bucket']);
		});
	}
}

<?php

	final class li_sysenvironment
	{
		private static $modules	= [];
		private static $running	= false;

		private static function exception(string $message, int $trace = 1)
		{
			return new li_sysexception('Environment: '.$message, $trace);
		}

		public static function use(string $module, &$useas = null)
		{
			if(self::exists($module))
			{
				return $useas = self::$modules[$module];
			}

			if(class_exists($class = 'li_sysmodule_'.$module))
			{
				return $useas = self::$modules[$module] = new $class;
			}

			if(class_exists($class = 'li_appmodule_'.$module))
			{
				return $useas = self::$modules[$module] = new $class;
			}

			throw self::exception('Modul "'.$module.'" tidak ditemukan');
		}

		private static function exists(String $key)
		{
			return isset(self::$modules[$key]);
		}

		public static function run(string $app)
		{
			if(self::$running)
			{
				throw self::exception('Boot: Jangan memanggil method "'.__method__.'"');
			}

			if(!class_exists($app))
			{
				throw self::exception('Class "'.$app.'" tidak ditemukan');
			}

			if(!method_exists(self::$modules['app'] = new $app, 'runapp'))
			{
				throw self::exception('Method "'.$app.'::runapp()" tidak ditemukan implementasikan abstract class "li_sysabstract_boot" pada class "'.$app.'"');
			}

			self::$running = true;
			self::use('app')->runapp();
		}
	}

	class_alias('li_sysenvironment', 'li_env');
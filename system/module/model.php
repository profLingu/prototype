<?php

	class li_sysmodule_model
	{
		private $models = [];

		private static function exception(string $message)
		{
			return new li_sysexception('Model: '.$message, 1);
		}

		public function exists(string $name)
		{
			return isset($this->models[$name]);
		}

		public function use(string $model, &$out = null)
		{
			if($this->exists($model))
			{
				throw self::exception($model.' sudah ada');
			}

			if(!class_exists($class = 'li_appmodel_'.$model))
			{
				throw self::exception('tidak bisa digunakan');
			}

			$this->add($model, $out = new $class($this));
		}

		public function get(string $key, &$out = null)
		{
			if(!$this->exists($key))
			{
				throw self::exception($key.' tidak ada');
			}

			return $out = $this->models[$key];
		}

		private function add(string $name, object $obj)
		{
			$this->models[$name] = $obj;
		}
	}
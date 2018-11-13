<?php

	abstract class li_sysabstract_boot
	{
		private $running = false;
		protected final function controller()
		{
			li_env::use('router', $router);

			if(empty($controller = $router->part(1)))
			{
				$controller = 'home';
			}

			if(empty($method = $router->part(2)))
			{
				$method = 'index';
			}

			$class = 'li_appcontroller_'.$controller;

			if(!class_exists($class) || '_' == substr($method, 0, 1) || !method_exists($class = new $class, $method) || !(new ReflectionMethod($class, $method))->isPublic())
			{
				$class	= $this;
				$method	= 'notfound';
			}

			return [$class, $method];
		}

		protected final function arguments()
		{
			return li_env::use('router')->parts(3);
		}

		protected abstract function notfound();

		public final function runapp()
		{	
			if($this->running)
			{
				throw new li_sysexception('Boot: Jangan memanggil method "'.__method__.'"');
			}

			$this->running = true;
			call_user_func_array($this->controller(), $this->arguments());
			if(li_env::use('response')->ready($response))
			{
				$response->show();
			}
		}
	}
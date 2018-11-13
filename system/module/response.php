<?php

	final class li_sysmodule_response
	{
		private $data	= null;
		private $type	= null;
		private $status	= null;

		public function __construct()
		{
			$this->status(200)->type('text/plain');
		}

		public function ready(&$useas)
		{
			$useas = $this;
			return boolval($this->data);
		}

		public function set(string $data)
		{
			$this->data = $data;
			return $this;
		}

		public function closure(closure $function)
		{
			ob_start();
			$function();
			return $this->set(ob_get_clean());
		}

		public function status(int $status)
		{
			$this->status = $status;
			return $this;
		}

		public function type(string $type)
		{
			$this->type = $type;
			return $this;
		}

		public function json($data, $ops = null)
		{
			$this->type('application/json')->set(json_encode($data, $ops));
		}

		public function show(string $type = null)
		{
			$statuses = [
				200 => 'OK',
				201 => 'Created',
				204 => 'No Content',
				206 => 'Partial Content',

				301 => 'Moved Permanently',
				302 => 'Found',

				400 => 'Bad Request',
				401 => 'Unauthorized',
				403 => 'Forbidden',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				409 => 'Conflict',
				413 => 'Payload Too Large',
				415 => 'Unsupported Media Type',
				422 => 'Unprocessable Entity',
				429 => 'Too Many Requests',
			];
			header($_SERVER['SERVER_PROTOCOL'].' '.$this->status.' '.$statuses[$this->status]);
			header('Content-type: '.$this->type);
			print $this->data;
		}
	}
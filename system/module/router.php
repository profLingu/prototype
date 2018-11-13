<?php

	final class li_sysmodule_router
	{
		private $array	= null;
		private $data	= null;
		private $count	= null;
		private $uri	= null;

		public function input(array $attributes, array $input = null)
		{
			if(!isset($this->data))
			{
				$this->input = json_decode(file_get_contents('php://input'), true);
			}

			return array_filter($input ?? $this->data, function($key) use($attributes)
			{
				return in_array($key, $attributes);
			}, ARRAY_FILTER_USE_KEY);
		}

		public function count()
		{
			if(!isset($this->count))
			{
				$this->count = count($this->array());
			}

			return $this->count;
		}

		public function part(Int $pos)
		{
			return $this->array()[$pos];
		}

		public function parts(Int $start, Int $end = null)
		{
			 $end	= isset($end) ? ($end - $start) : $end;
			 return array_slice($this->array(), $start, $end);
		}

		public function uri()
		{
			if(!isset($this->uri))
			{
				$this->uri = (object) parse_url($_SERVER['REQUEST_URI']);
			}

			return $this->uri;
		}

		public function array()
		{
			if(!isset($this->array))
			{
				$this->array = explode('/', $this->uri()->path);
			}

			return $this->array;
		}
	}
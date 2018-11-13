<?php

	class li_sysexception extends exception
	{
		private $messageOnly = false;

		public function __construct(String $message, int $trace = 0)
		{
			if(null !== $trace = parent::getTrace()[$trace])
			{
				$this->file = $trace['file'];
				$this->line = $trace['line'];
			}

			else throw new self('Trace tidak ditemukan', 0);
			parent::__construct($message);
		}

		public function messageOnly(bool $mode = true)
		{
			$this->messageOnly = true;
			return $this;
		}

		public final function __toString()
		{
			if($this->messageOnly === true)
			{
				return parent::getMessage();
			}

			return parent::getMessage().' di '.$this->file.':'.$this->line;
		}
	}
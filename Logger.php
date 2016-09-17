<?php

namespace RWD;

use Monolog;

class Logger extends \Monolog\Logger
{
	private $_handlers = array();
	private $_handlersPushed = FALSE;

	public function addHandler ($handler)
	{
		if (empty($handler) || $this->_handlersPushed) {
			return FALSE;
		}

		$this->_handlers[] = $handler;

		return $handler;
	}

	public function format ($format = NULL, $dateFormat = NULL, $allowInlineLineBreaks = FALSE, $ignoreEmptyContextAndExtra = FALSE)
	{
		if ($this->_handlersPushed) {
			return FALSE;
		}

		$formatter = new Monolog\Formatter\LineFormatter($format, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);

		foreach ($this->_handlers as $handler) {
			$handler->setFormatter($formatter);
			$this->pushHandler($handler);
		}

		return $this->_handlersPushed = TRUE;
	}

	public function pushHandlers ()
	{
		if ($this->_handlersPushed) {
			return FALSE;
		}

		foreach ($this->_handlers as $handler) {
			$this->pushHandler($handler);
		}

		return $this->_handlersPushed = TRUE;
	}
}
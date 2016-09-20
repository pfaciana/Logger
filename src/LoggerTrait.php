<?php

namespace RWD;

trait LoggerTrait
{
	protected $_logger;
	protected $_defaultName = 'rwd_logger';
	protected $_times = array();

	public function setLogger ($logger)
	{
		return $this->_logger = $logger;
	}

	public function getLogger ()
	{
		if (!empty($this->_logger)) {
			return $this->_logger;
		}

		if (!empty($GLOBALS[$this->_defaultName])) {
			return $this->setLogger($GLOBALS[$this->_defaultName]);
		}

		return FALSE;
	}

	public function out ($message, $context = array(), $type = 'debug')
	{
		if (empty($context)) {
			$context = array();
		}

		if (!empty($this->getLogger())) {
			$this->_logger->$type($message, $context);
		}
		else {
			echo $message . "\n";
		}
	}

	public function logDebug ($message, $context = array())
	{
		$this->out($message, $context, 'debug');
	}

	public function logInfo ($message, $context = array())
	{
		$this->out($message, $context, 'info');
	}

	public function logNotice ($message, $context = array())
	{
		$this->out($message, $context, 'notice');
	}

	public function logWarn ($message, $context = array())
	{
		$this->out($message, $context, 'warn');
	}

	public function logError ($message, $context = array())
	{
		$this->out($message, $context, 'error');
	}

	public function logCritical ($message, $context = array())
	{
		$this->out($message, $context, 'critical');
	}

	public function logAlert ($message, $context = array())
	{
		$this->out($message, $context, 'alert');
	}

	public function logEmergency ($message, $context = array())
	{
		$this->out($message, $context, 'emergency');
		die("\n SHUTDOWN: {$message} \n\n");
	}

	public function time ($key = '', $format = TRUE)
	{
		if (!isset($this->_times[$key]) || !isset($this->_times[$key]['start'])) {
			$this->_times[$key] = array(
				'start' => microtime(TRUE),
				'end'   => NULL,
			);

			return NULL;
		}

		$this->_times[$key]['end'] = microtime(TRUE);

		$diff = $this->_times[$key]['end'] - $this->_times[$key]['start'];

		if ($format) {
			if ($diff < 1) {
				return number_format($diff * 1000, 0) . ' ms';
			}

			if ($diff < 60) {
				return number_format($diff, 1) . ' seconds';
			}

			return floor($diff / 60) . ' minutes and ' . $diff % 60 . ' seconds';
		}

		return $diff;
	}

	public function getAllTimers ()
	{
		return $this->_times;
	}
}
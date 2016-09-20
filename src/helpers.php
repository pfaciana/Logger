<?php

require_once('Logger.php');

use RWD\Logger;

global $rwd_logger;

$rwd_logger = new Logger('RWD_Logger');

function lhandler ($handler)
{
	global $rwd_logger;

	$rwd_logger->addHandler($handler);
}

function lhandlers ()
{
	global $rwd_logger;

	$rwd_logger->pushHandlers();
}

function lformat ($format = NULL, $dateFormat = NULL, $allowInlineLineBreaks = FALSE, $ignoreEmptyContextAndExtra = TRUE)
{
	global $rwd_logger;

	$rwd_logger->format($format, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);
}

// DEBUG (100): Detailed debug information

function out ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->debug($message, $context);
}

function llog ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->debug($message, $context);
}

function ldebug ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->debug($message, $context);
}

// INFO (200): Interesting events.

function linfo ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->info($message, $context);
}

// NOTICE (250): Normal but significant events.

function lnotice ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->notice($message, $context);
}

// WARNING (300): Exceptional occurrences that are not errors.

function lwarn ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->warning($message, $context);
}

// ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.

function lerror ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->error($message, $context);
}

// CRITICAL (500): Critical conditions.

function lcritical ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->critical($message, $context);
}

// ALERT (550): Action must be taken immediately.

function lalert ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->alert($message, $context);
}

// EMERGENCY (600): Emergency: system is unusable.

function lemergency ($message, array $context = array())
{
	global $rwd_logger;

	$rwd_logger->emergency($message, $context);
}

function ldelete ($filepath, $logger = NULL)
{
	global $rwd_logger;

	if (empty($filepath)) {
		return;
	}

	if (empty($logger)) {
		$logger = $rwd_logger;
	}

	unlink($filepath);

	$logger->debug("Delete: {$filepath}");
}
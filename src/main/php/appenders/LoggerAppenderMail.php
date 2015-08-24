<?php

namespace Eksoga\log4php\appenders;

/**
 * LoggerAppenderMail appends log events via email.
 *
 * This appender does not send individual emails for each logging requests but 
 * will collect them in a buffer and send them all in a single email once the 
 * appender is closed (i.e. when the script exists). Because of this, it may 
 * not appropriate for long running scripts, in which case 
 * LoggerAppenderMailEvent might be a better choice.
 * 
 * This appender uses a layout.
 * 
 * ## Configurable parameters: ##
 * 
 * - **to** - Email address(es) to which the log will be sent. Multiple email 
 *     addresses may be specified by separating them with a comma.
 * - **from** - Email address which will be used in the From field.
 * - **subject** - Subject of the email message.
 * 
 * @version $Revision$
 * @package log4php
 * @subpackage appenders
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @link http://logging.apache.org/log4php/docs/appenders/mail.html Appender documentation
 */
class LoggerAppenderMail extends \LoggerAppender {

	/** 
	 * Email address to put in From field of the email.
	 * @var string
	 */
	protected $from = null;

	/** 
	 * The subject of the email.
	 * @var string
	 */
	protected $subject = 'Log4php Report';
	
	/**
	 * One or more comma separated email addresses to which to send the email. 
	 * @var string
	 */
	protected $to = null;
	
	/**
	 * One or more comma separated email addresses to which to send the email. 
	 * @var string
	 */
	protected $fake = '';

	/** 
	 * Indiciates whether this appender should run in dry mode.
	 * @deprecated
	 * @var boolean 
	 */
	protected $dry = false;

	/** 
	 * Buffer which holds the email contents before it is sent. 
	 * @var string  
	 */
	protected $body = '';
	
	public function append(\LoggerLoggingEvent $event) {
		if($this->layout !== null) {
			$this->body .= $this->layout->format($event);
		}
	}
	
	public function close() {
		if($this->closed != true) {
			$from = $this->from;
			$to = $this->to;
	
			if(!empty($this->body) and $from !== null and $to !== null and $this->layout !== null) {
				$subject = $this->subject;
				if(!$this->dry) {
					mail(
						$to, $subject, 
						$this->layout->getHeader() . $this->body . $this->layout->getFooter(),
						"From: {$from}\r\n".$this->layout->getHeaders());
				} else {
				    echo "DRY MODE OF MAIL APP.: Send mail to: ".$to." with content: ".$this->body;
				}
			}
			$this->closed = true;
		}
	}
	
	/** Sets the 'subject' parameter. */
	public function setSubject($subject) {
		$this->setString('subject', $subject);
	}
	
	/** Returns the 'subject' parameter. */
	public function getSubject() {
		return $this->subject;
	}
	
	/** Sets the 'to' parameter. */
	public function setTo($to) {
		$this->setString('to', $to);
	}
	
	/** Returns the 'to' parameter. */
	public function getTo() {
		return $this->to;
	}

	/** Sets the 'from' parameter. */
	public function setFrom($from) {
		$this->setString('from', $from);
	}
	
	/** Returns the 'from' parameter. */
	public function getFrom() {
		return $this->from;
	}

	/** Enables or disables dry mode. */
	public function setDry($dry) {
		$this->setBoolean('dry', $dry);
	}
	
	/** Test for fake param. */
	public function setFake($fake) {
		$this->setString('fake', $fake);
	}
}

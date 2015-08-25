<?php

namespace Eksoga\log4php\layouts;

/**
 * This layout outputs events in a HTML table.
 *
 * Configurable parameters for this layout are:
 * 
 * - title
 * - locationInfo
 *
 * An example for this layout:
 * 
 * {@example ../../examples/php/layout_html.php 19}<br>
 * 
 * The corresponding XML file:
 * 
 * {@example ../../examples/resources/layout_html.properties 18}
 * 
 * The above will print a HTML table that looks, converted back to plain text, like the following:<br>
 * <pre>
 *    Log session start time Wed Sep 9 00:11:30 2009
 *
 *    Time Thread Level Category   Message
 *    0    8318   INFO  root       Hello World!
 * </pre>
 * 
 * @version $Revision$
 * @package log4php
 * @subpackage layouts
 */
class LoggerLayoutHtml extends \LoggerLayout {
	/**
	 * The <b>LocationInfo</b> option takes a boolean value. By
	 * default, it is set to false which means there will be no location
	 * information output by this layout. If the the option is set to
	 * true, then the file name and line number of the statement
	 * at the origin of the log statement will be output.
	 *
	 * <p>If you are embedding this layout within a {@link LoggerAppenderMail}
	 * or a {@link LoggerAppenderMailEvent} then make sure to set the
	 * <b>LocationInfo</b> option of that appender as well.
	 * @var boolean
	 */
	protected $locationInfo = false;
	
	/**
	 * The <b>Title</b> option takes a String value. This option sets the
	 * document title of the generated HTML document.
	 * Defaults to 'Log4php Log Messages'.
	 * @var string
	 */
	protected $title = "Log4php Log Messages";
	
	/**
	 * Path to file header html layout
	 */
	protected $htmlHeader = "";
	/**
	 * Path to file body html layout
	 */
	protected $htmlBody = "";
	/**
	 * Path to file footer html layout
	 */
	protected $htmlFooter = "";
	
	/**
	 * The <b>LocationInfo</b> option takes a boolean value. By
	 * default, it is set to false which means there will be no location
	 * information output by this layout. If the the option is set to
	 * true, then the file name and line number of the statement
	 * at the origin of the log statement will be output.
	 *
	 * <p>If you are embedding this layout within a {@link LoggerAppenderMail}
	 * or a {@link LoggerAppenderMailEvent} then make sure to set the
	 * <b>LocationInfo</b> option of that appender as well.
	 */
	public function setLocationInfo($flag) {
		$this->setBoolean('locationInfo', $flag);
	}

	/**
	 * Returns the current value of the <b>LocationInfo</b> option.
	 */
	public function getLocationInfo() {
		return $this->locationInfo;
	}
	
	/**
	 * The <b>Title</b> option takes a String value. This option sets the
	 * document title of the generated HTML document.
	 * Defaults to 'Log4php Log Messages'.
	 */
	public function setTitle($title) {
		$this->setString('title', $title);
	}

	/**
	 * @return string Returns the current value of the <b>Title</b> option.
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * @return string Returns the content type output by this layout, i.e "text/html".
	 */
	public function getContentType() {
		return "text/html";
	}
	
	/**
	 * @return string Returns the html headers.
	 */
	public function getHeaders() {
	    $sbuf = 'Content-type: '.$this->getContentType().'; charset=utf-8\r\n';
	    return $sbuf;
	}
	
	/**
	 * The <b>htmlBody</b> option takes a String value. This option sets the
	 * file header layout for message.
	 */
	public function setHtmlHeader($file) {
	    $this->setString('htmlHeader', $file);
	}
	
	/**
	 * The <b>htmlBody</b> option takes a String value. This option sets the
	 * file repeated body layout for message.
	 */
	public function setHtmlBody($file) {
	    $this->setString('htmlBody', $file);
	}
	
	/**
	 * The <b>htmlBody</b> option takes a String value. This option sets the
	 * file footer layout for message.
	 */
	public function setHtmlFooter($file) {
	    $this->setString('htmlFooter', $file);
	}
	
	/**
	 * @param LoggerLoggingEvent $event
	 * @return string
	 */
	public function format(\LoggerLoggingEvent $event) {
	    ob_start();
	    include($this->htmlBody);
	    $sbuf = ob_get_clean();
	    return $sbuf;
	}

	/**
	 * @return string Returns appropriate HTML headers.
	 */
	public function getHeader() 
	{
	    ob_start();
	    include($this->htmlHeader);
	    $sbuf = ob_get_clean();
	    return $sbuf;
	}

	/**
	 * @return string Returns the appropriate HTML footers.
	 */
	public function getFooter() 
	{
	    ob_start();
	    include($this->htmlFooter);
	    $sbuf = ob_get_clean();
	    return $sbuf;
	}
}

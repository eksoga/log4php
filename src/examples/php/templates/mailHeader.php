<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
	<title><?=$this->title;?></title>
	<style type="text/css">
	<!--
	body, table {font-family: arial,sans-serif; font-size: x-small;}
	th {background: #F28D1A; color: #FFFFFF; text-align: left;}
	-->
	</style>
    </head>
    <body bgcolor="#FFFFFF" topmargin="6" leftmargin="6">
	<hr size="1" noshade>
	Log session start time <?=strftime('%c', time());?><br>
	<br>
	<table cellspacing="0" cellpadding="4" border="1" bordercolor="#224466" width="100%">
	    <tr>
		<th>Time</th>
		<th>Thread</th>
		<th>Level</th>
		<th>Category</th>
		<?php if ($this->locationInfo) : ?>
		    <th>File:Line</th>
		<?php endif; ?>
		<th>Message</th>
	    </tr>

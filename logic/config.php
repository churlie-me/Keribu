<?php
phpinfo();
	$connect = mysql_connect('localhost:81', 'root', '');
	if(!$connect)
	die('connection failure..'.mysql_error());
	
	$dbselect = mysql_select_db('keribu', $connect);
	if(!$dbselect)
	die('No database found'.mysql_error());

?>
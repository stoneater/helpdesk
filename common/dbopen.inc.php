<?php
//Connect to database server...
$connection = @mysql_connect($db_server, $db_username, $db_password);

if (!$connection) {
	print "<title>Error</title><font size=\"1\" face=\"Verdana, Arial, Geneva\">";
    die (sprintf ("<b>Error [%d]:</b> %s", 
             mysql_errno (), mysql_error ())); 
}

//Select database...
$db_select = @mysql_select_db($db_database);

if (!$db_select) {
	print "<title>Error</title><font size=\"1\" face=\"Verdana, Arial, Geneva\">";
    die (sprintf ("<b>Error [%d]:</b> %s", 
             mysql_errno (), mysql_error ())); 
}
?>

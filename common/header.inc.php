<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
            "http://www.w3.org/TR/html4/strict.dtd">
<html>
<meta http-equiv="refresh" content="900" />
<link rel="stylesheet" type="text/css" href="/it_helpdesk/style.css" media="screen" />
<a name="top"></a>
<body>
<img src="images/logo.gif" style="opacity:0.8;filter:alpha(opacity=40)" border="0" alt="<?php print $app_title?><?php print"\n"?>Powered by Linux"><br>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="2"></td>
</tr>
<tr>
	<td width="100%">
	
<table border="0" cellspacing="0" cellpadding="3">
<tr>
	<td align="center" nowrap><a href="add.php" title="Submit a new work order"><img src="images/small/submit_new.gif" border="0" alt="Submit a new work order" width="16" height="16"><br>Submit</a></td>
<td align="center"><img src="images/hline.gif" border="0" alt="" width="1" height="20"></td>
	<td align="center" nowrap><a title="View work orders" href="index.php"><img src="images/small/view_wo.gif" border="0" alt="View work order(s)" width="16" height="16"><br>View</a></td>
<td align="center"><img src="images/hline.gif" border="0" alt="" width="1" height="20"></td>
	<td align="center" nowrap><a title="View reports" href="stats.php"><img src="images/small/reports.gif" border="0" alt="View statistics" width="16" height="16"><br>Stats</a></td>
	<td align="center"><img src="images/hline.gif" border="0" alt="" width="1" height="20"></td>
	<td align="center" nowrap><a title="Search for work order(s)" href="search.php"><img src="images/small/search.gif" border="0" alt="Search for work order(s)" width="16" height="16"><br>Search</a></td>
</tr>
</table>	

	</td>
	<td align="right">
	
<table border="0" cellspacing="0" cellpadding="3">
<tr>
<?php
session_start();
if ($_SESSION['login'] == 'ok')
{
?>
	<td align="center" nowrap><a title="Logout" href="logout.php"><img src="images/small/login.gif" border="0" alt="Logout" width="16" height="16"><br>Logout</a></td>
<?php
} else {
?>
	<td align="center" nowrap><a title="Login" href="login.php"><img src="images/small/login.gif" border="0" alt="Login" width="16" height="16"><br>Login</a></td>
<?php
}
?>
	<td align="center"><img src="images/hline.gif" border="0" alt="" width="1" height="20"></td>
	<td align="center" nowrap><a title="Help" href="help.php"><img src="images/small/help.gif" border="0" alt="Help" width="16" height="16"><br>Help</a></td>
	<td align="center"><img src="images/hline.gif" border="0" alt="" width="1" height="20"></td>
	<td align="center" nowrap><a title="About OWOS: Lite Edition for PHP <?php print $app_version?>" href="about.php"><img src="images/small/completed.gif" border="0" alt="About OWOS: Lite Edition for PHP <?php print $app_version?>" width="16" height="16"><br>About</a></td>
</tr>
</table>	

	</td>
</tr>
<tr bgcolor="<?php print $line_color?>">
	<td colspan="2"><img src="images/space.gif" height="1" width="1" alt="" border="0"></td>
</tr>
</table>
<hr />
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
	<td>




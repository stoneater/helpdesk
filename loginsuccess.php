<?php
include 'header.php';

if ($_POST['id'])
{
	$id = $_POST['id'];
}
if ($_GET['id'])
{
	$id = $_GET['id'];
}
if ($_POST['inventory_id'])
{
	$inventory_id = $_POST['inventory_id'];
}
if ($_GET['inventory_id'])
{
	$inventory_id = $_GET['inventory_id'];
}
if ($_POST['adding'])
{
	$adding = $_POST['adding'];
}
?>
<div data-role="dialog" id="edit">

<?php
if ($_POST['password'] != 'W@rriors')
{
?>
	<div data-role="header" data-theme="a" data-inline="true">
		<h6>Incorrect Password!</h6>
	</div><!-- /header -->	
	<div data-role="content">
<?php 
	if ($id)
	{
	?>
	<p>Incorrect!</p>
		<script language="javascript"><!--
		location.replace("mobilelogin.php?id=<?php print $id;?>")
		//-->
		</script>
	<?php
	} else {
	?>
	<p>Incorrect!</p>
		<script language="javascript"><!--
		location.replace("mobilelogin.php")
		//-->
		</script>
	<?php
	}
	?>
	</div>
	<?
} else {
	//session_start();
	$login = 'ok';
	//session_register('login');
	$_SESSION['id'] = $login;
	session_cache_expire(20);
?>
	<div data-role="header" data-theme="a" data-inline="true">
		<h6>Success!</h6>
	</div><!-- /header -->	
	<div data-role="content">
	<?php 
	if ($id)
	{
	?>
	<p>You'll Be Automatically Redirected</p>
		<script language="javascript"><!--
		location.replace("edit.php?id=<?php print $id;?>")
		//-->
		</script>
	<?php
	} else {
	?>
		<p>You'll Be Automatically Redirected</p>
			<script language="javascript"><!--
			location.replace("index.php")
			//-->
			</script>
	<?php
	}
}
?>
</div>
</div>
<?php
include 'footer.php';
?>

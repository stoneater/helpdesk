<?php
include 'header.php'; 

$script = $_SERVER['PHP_SELF'];

if ($_POST['id'])
{
	$id = $_POST['id'];
}
if ($_GET['id'])
{
	$id = $_GET['id'];
}
if ($_POST['adding'])
{
	$adding = $_POST['adding'];
}
if ($_GET['inventory_id'])
{
	$id = $_GET['inventory_id'];
}

?>
<div data-role="dialog">
	<div data-role="header" data-theme="a" data-inline="true">
		<h6>Login</h6>
	</div><!-- /header -->	
	<div data-role="content">
<?php
	if ($id)
	{
	?>
		<form action="loginsuccess.php?id=<?php print $id;?>" method="post">
			<label for="basic">Password?</label>
			<input type="password" name="password" />
			<span data-mini="true">
				<input type="button" value="Back" class="button" title="Go back" onclick="javascript:location.href='index.php'" data-inline="true" data-theme="c">
				<input type="submit" name="Login" value="Login" class="button" title="Login to system" data-inline="true" data-theme="c" />	
				<input type="hidden" name="id" value="<?php print $id;?>" />
			</span>	
		</form>
	<?php
	} else {
	?>
		<form action="loginsuccess.php" method="post">
			<label for="basic">Password?</label>
			<input type="password" name="password" />
			<span data-mini="true">
				<input type="button" value="Back" class="button" title="Go back" onclick="javascript:location.href='index.php'" data-inline="true" data-theme="c">
				<input type="submit" name="Login" value="Login" class="button" title="Login to system" data-inline="true" data-theme="c" />	
				<input type="hidden" name="adding" value="yes" />
			</span>	
		</form>
	<?php
	}	
	?>
</div>
</div>
<?php
include 'footer.php'; ?>

<?php 
include_once 'header.php';

if ($_POST['building']){ $building = $_POST['building'];}
if ($_POST['room']){ $room = $_POST['room'];}
if ($_POST['item']){ $item = $_POST['item'];}
 ?>
<script>
	function sendForm() {
		document.building.submit()
	}
</script>
<div data-role="dialog">
	<div data-role="header" data-theme="a">
				<h1>Submit Workorder</h1>
		</div><!-- /header -->	
		<div data-role="content">
<?php 
if ($_POST['building']) {
	echo $building;?><br /><hr /><?

	if ($_POST['room']) {
		echo $room;?><br /><hr /><?
	
		if ($_POST['item']) {
			echo $building;?><br /><?
			echo $room;	?><br /><?
			echo $item;
			
		} else {
			
		$query = "SELECT SN, common_name, building, room FROM inventory.inventory WHERE building LIKE '".$building."' AND room LIKE '".$room."' ORDER BY common_name ASC";
		$result = mysql_query($query);

			echo '<form name="building" method="post" onSubmit="new1.php"><select name="item" onChange="sendForm()">';
			while ($rs = mysql_fetch_assoc($result))
				{
					echo '<option value="' . $rs['SN'] . '">' . $rs['common_name'] . ' | ' . $rs['SN'] . '</option>';
				}
			echo '<option value="Not Listed">Not Listed</option><input type="hidden" name="building" value="'.$building.'"><input type="hidden" name="room" value="'.$room.'">';
			echo '</select></form>';
			
			mysql_free_result($result);	 
			
		}	
	} else {
	
		$query = "SELECT DISTINCT location FROM masterphonelist.masterphonelist WHERE Building LIKE '".$building."' ORDER BY location ASC";
		$result = mysql_query($query);

			echo '<form name="building" method="post" onSubmit="changeSite2.php"><select name="room" onChange="sendForm()">';
			while ($rs = mysql_fetch_assoc($result))
				{
					echo '<option value="' . $rs['location'] . '">' . $rs['location'] . '</option>';
				}
			echo '<option value="Not Listed">Not Listed</option><input type="hidden" name="building" value="'.$building.'">';
			echo '</select></form>';
			
			mysql_free_result($result);	 
	}
	
} else {
?>
<form name="building" method="post" onSubmit="changeSite2.php">
	<select name="building" onChange="sendForm()">
		<option value=""></option>
		<option value="High">High</option>
		<option value="Middle">Middle</option>
	</select>
</form>
<?php  } 
?>
	</div>
	</div>
<?php
include_once 'footer.php';?>
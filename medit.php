<?php
include_once 'header.php';
if ($_POST['id']){ $id = $_POST['id'];}
if ($_GET['id']){ $id = $_GET['id'];}
?>
<script language="JavaScript" type="text/javascript">
<!--
// IsNumeric Function
function IsNumeric(sText)
{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;


   for (i = 0; i < sText.length && IsNumber == true; i++)
      {
      Char = sText.charAt(i);
      if (ValidChars.indexOf(Char) == -1)
         {
         IsNumber = false;
         }
      }
   return IsNumber;

}

//<!--

// Email Validation Function
function validateEmail(sText) {
  var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
  return regex.test(sText);
}

// Check the form
function checkForm () {
	TheForm = (document.edit)
	
	// Check for Common Name
	if (TheForm.common_name.value==""){
		alert("Please enter the Common Name.\ne.g.: E4500")
		TheForm.common_name.focus();
		return false;
	}
	
		// Check for Serial Number
	if (TheForm.sn.value==""){
		alert("Please enter the Serial Number.\ne.g.: a2431")
		TheForm.sn.focus();
		return false;
	}

	// Check to see that a Building has been selected
	if (TheForm.building.selectedIndex==0){
		alert("Please select a building.\ne.g.: High School")
		TheForm.building.focus();
		return false;
	}
	
	// Check for a Room
	if (TheForm.room.value==""){
		alert("Please enter a room.\ne.g.: 201")
		TheForm.room.focus();
		return false;
	}	
	
	// Check for a computer model id
	if (TheForm.computer_model_id.value==""){
		alert("Please enter a computer model.\ne.g. Gateway 4500")
		TheForm.computer_model_id.focus();
		return false;
	}

	return true
}
// -->
</script>
<style>
  .mybg {
	background-image: url('images/warrior1.png') !important;
	background-repeat: no-repeat;
	background-position: center;
  }
</style>
<div data-role="dialog">
	<div data-role="header" data-theme="a">
				<h1>Edit Record #<?php print $id?></h1>
		</div><!-- /header -->	
		<div data-role="content" class="mybg">
	
<?php
//Check for what type of hardware is being edited
$top_sql_statement = "SELECT *, DATE_FORMAT(created, '%m/%d/%y') AS created, DATE_FORMAT(stamp, '%l:%i %p') AS submitTime, Sec_to_time(Avg (Timestampdiff (second, stamp, completedStamp))) AS timeTaken FROM " . $db_table . " WHERE id = " . $id . "";

//Execute built query...
$top_results = mysql_query($top_sql_statement) or die ('Error in <b>' . $top_sql_statement . '</b>. ' . mysql_error());

//Debug...
if ($debuging)
{
	print '<b>DEBUG:</b> ' . $sql_statement . '<p>';
}

if ($rs = mysql_fetch_array($top_results))
{
				$id = $rs['id'];
				$created = $rs['created'];
				$requestedby = $rs['requestedby'];
				$building = $rs['building'];
				$room = $rs['room'];
				$item = $rs['item'];
				$item2 = $rs['item2'];
				$item3 = $rs['item3'];
				$item4 = $rs['item4'];
				$item5 = $rs['item5'];
				$assignedto = $rs['assignedto'];
				$email = $rs['email'];
				if ($technician == '') {
				$technician = 'Unassigned';
				}
				$problem = $rs['problem'];
				$solution = $rs['solution'];
				$priorityNumber = $rs['priority'];
				$timeTaken = $rs['timeTaken'];
				$stamp = $rs['stamp'];
				$completedStamp = $rs['completedStamp'];
				$submitTime = $rs['submitTime'];
				switch ($priorityNumber) {
					case 1:
						$priority = "Alert";
						break;
					case 2:
						$priority = "High";
						break;
					case 3:
						$priority = "Normal";
						break;
					case 4:
						$priority = "Low";
						break;
					case 5:
						$priority = "Tech/Alert";
						break;
					case 6:
						$priority = "Tech/High";
						break;
					case 7:
						$priority = "Tech/Normal";
						break;
					case 8:
						$priority = "Tech/Low";
						break;
				}
				$status = $rs['status'];
	
?>	
<form action="mupdate.php" method="post" name="edit">
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="id" value="<?php print $id?>">
<b>
		<label for="basic">Assigned To:</label>
			<?php include_once '../home/common/assignedto.inc.php';?>	
		<br />
		<label for="basic">Building:</label></b>	
			<?php echo $building;?>	<b>	
		<br />
		<br />
		<label for="basic">Room:</label></b>	
			<?php echo $room;?>	<b>
		<br />
		<br />
		<label for="basic">Problem:</label></b>
			<?php echo $problem;?>	
		<br />
		<br />
</b>	
		<table align="center">
			<tr>
				<td><input type="button" value="Back" class="button" title="Go back" onclick="javascript:location.href='/helpdesk/index.php'" data-inline="true" data-theme="e"></td>
				<?php
					if ($delete) {
						?>
						<input type="hidden" name="delete" value="yes" />
						<?php
					}
				?>
				<input type="hidden" name="email" value="<?php print $email?>">
				<input type="hidden" name="from" value="<?php print $requestedby?>">
				<td><input type="submit" name="Update" value="Update" class="button" title="Update inventory item" data-inline="true" data-theme="a"></td>
			</tr>
		</table>
</form>
<?
}
include_once 'footer.php';
?>

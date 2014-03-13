<?php
include_once 'header.php';
if ($_POST['id']){ $id = $_POST['id'];}
if ($_GET['id']){ $id = $_GET['id'];}
if ($_GET['delete']){	$delete = $_GET['delete'];}

if($_SESSION['id'] == 'ok')
{
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
<form action="update.php" method="post" name="edit">
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="id" value="<?php print $id?>">
<b>
	<br />
		<label for="basic">ID:</label>
</b>
			<label for="basic"><?php print $id?></label>
<b>
	<br />
		<label for="basic">Created:</label>
</b>		
			<label for="basic"><?php print $created?></label>
<b>
	<br />
		<label for="basic">Time Created:</label>
</b>		
			<label for="basic"><?php print $submitTime?></label>			
<b>
	<br />
		<label for="basic">Submitted By:</label>
</b>		
			<label for="basic"><?php print $requestedby?></label>
			<input type="hidden" name="requestedby" value="<?php print $requestedby?>">			
<b>	
	<br />
		<label for="basic">Email:</label>
</b>
			<label for="basic"><?php print $email?></label>	
<b>			
	<br />
	<br />
		<label for="basic">Priority:</label>
			<select name="priority">
				<option value="4"<?php if ($priority == "Low") print ' selected';?>>Low</option>
				<option value="3"<?php if ($priority == "Normal") print ' selected';?>>Normal</option>
				<option value="2"<?php if ($priority == "High") print ' selected';?>>High</option>
				<option value="1"<?php if ($priority == "Alert") print ' selected';?>>Alert</option>
				<?php if ($_SESSION['id']) { ?><option value="5"<?php if ($priority == "Tech/Alert") print ' selected';?>>Tech/Alert</option><?php } ?>
				<?php if ($_SESSION['id']) { ?><option value="6"<?php if ($priority == "Tech/High") print ' selected';?>>Tech/High</option><?php } ?>
				<?php if ($_SESSION['id']) { ?><option value="7"<?php if ($priority == "Tech/Normal") print ' selected';?>>Tech/Normal</option><?php } ?>
				<?php if ($_SESSION['id']) { ?><option value="8"<?php if ($priority == "Tech/Low") print ' selected';?>>Tech/Low</option><?php } ?>
			</select>
		<label for="basic">Assigned To:</label>
			<?php include_once '../home/common/assignedto.inc.php';?>			
		<label for="basic">Building:</label>	
			<?php include_once 'common/buildings.inc.php';?>		
		<label for="basic">Room:</label>	
			<input type="text" name="room" value="<?php print $room?>" maxlength="255" data-inline="true" />	
		<label for="basic">Item:</label>
			<input type="text" name="item" value="<?php print $item?>" maxlength="255" data-inline="true" />	
		<?php
			$mystring = $item;
			$mystring = substr($mystring, 0, strpos($mystring, "|"));
			if($mystring != ''){
				$sql_statement = "SELECT inventory.inventory_id, inventory.SN FROM inventory.inventory WHERE SN = '$mystring'";
				$results = mysql_query($sql_statement);
				if ($rs = mysql_fetch_array($results, MYSQL_ASSOC))
				{				
					$inventory_id = $rs['inventory_id'];
					?>		
					<label for="basic">Inventory Item Link:</label>
					<br />
						<a href="/inventory/edit.php?inventory_id=<?php echo $inventory_id;?>">Click Here</a>
					<br />
					<br />		
			<?php
				} // End fetch array
			} // End checking for serial number
		if ($item2) {
		?>
		<label for="basic">Item 2:</label>
			<input type="text" name="item2" value="<?php print $item2?>" maxlength="255" data-inline="true" />	
		<?php
			$mystring = $item2;
			$mystring = substr($mystring, 0, strpos($mystring, "|"));
			if($mystring != ''){
				$sql_statement = "SELECT inventory.inventory_id, inventory.SN FROM inventory.inventory WHERE SN = '$mystring'";
				$results = mysql_query($sql_statement);
				if ($rs = mysql_fetch_array($results, MYSQL_ASSOC))
				{				
					$inventory_id = $rs['inventory_id'];
					?>		
					<label for="basic">Inventory Item Link:</label>
					<br />
						<a href="/inventory/edit.php?inventory_id=<?php echo $inventory_id;?>">Click Here</a>
					<br />
					<br />		
			<?php
				} // End fetch array
			} // End checking for serial number
		} // End checking for item 2
		if ($item3) {
		?>
		<label for="basic">Item 3:</label>
			<input type="text" name="item3" value="<?php print $item3?>" maxlength="255" data-inline="true" />	
		<?php
			$mystring = $item3;
			$mystring = substr($mystring, 0, strpos($mystring, "|"));
			if($mystring != ''){
				$sql_statement = "SELECT inventory.inventory_id, inventory.SN FROM inventory.inventory WHERE SN = '$mystring'";
				$results = mysql_query($sql_statement);
				if ($rs = mysql_fetch_array($results, MYSQL_ASSOC))
				{				
					$inventory_id = $rs['inventory_id'];
					?>		
					<label for="basic">Inventory Item Link:</label>
					<br />
						<a href="/inventory/edit.php?inventory_id=<?php echo $inventory_id;?>">Click Here</a>
					<br />
					<br />		
			<?php
				} // End fetch array
			} // End checking for serial number
		} // End checking for item 3
		if ($item4) {
		?>
		<label for="basic">Item 4:</label>
			<input type="text" name="item4" value="<?php print $item4?>" maxlength="255" data-inline="true" />	
		<?php
			$mystring = $item4;
			$mystring = substr($mystring, 0, strpos($mystring, "|"));
			if($mystring != ''){
				$sql_statement = "SELECT inventory.inventory_id, inventory.SN FROM inventory.inventory WHERE SN = '$mystring'";
				$results = mysql_query($sql_statement);
				if ($rs = mysql_fetch_array($results, MYSQL_ASSOC))
				{				
					$inventory_id = $rs['inventory_id'];
					?>		
					<label for="basic">Inventory Item Link:</label>
					<br />
						<a href="/inventory/edit.php?inventory_id=<?php echo $inventory_id;?>">Click Here</a>
					<br />
					<br />		
			<?php
				} // End fetch array
			} // End checking for serial number
		} // End checking for item 4	
		if ($item5) {
		?>
		<label for="basic">Item 5:</label>
			<input type="text" name="item5" value="<?php print $item5?>" maxlength="255" data-inline="true" />	
		<?php
			$mystring = $item5;
			$mystring = substr($mystring, 0, strpos($mystring, "|"));
			if($mystring != ''){
				$sql_statement = "SELECT inventory.inventory_id, inventory.SN FROM inventory.inventory WHERE SN = '$mystring'";
				$results = mysql_query($sql_statement);
				if ($rs = mysql_fetch_array($results, MYSQL_ASSOC))
				{				
					$inventory_id = $rs['inventory_id'];
					?>		
					<label for="basic">Inventory Item Link:</label>
					<br />
						<a href="/inventory/edit.php?inventory_id=<?php echo $inventory_id;?>">Click Here</a>
					<br />
					<br />		
			<?php
				} // End fetch array
			} // End checking for serial number
		} // End checking for item 5		
		?>		
		<label for="basic">Problem:</label>
			<textarea name="problem"><?php print $problem?></textarea>
		<label for="basic">Solution:</label>
			<textarea name="solution"><?php print $solution?></textarea>
		<label for="basic">Status:</label>
			<select name="status">
				<option<?php if ($status == 'New') print ' selected';?>>New</option>
					<option<?php if ($status == 'Awaiting Parts') print ' selected';?>>Awaiting Parts</option>
					<option<?php if ($status == 'On Hold - Awaiting') print ' selected';?>>On Hold - Awaiting</option>
					<option<?php if ($status == 'Out for Repair') print ' selected';?>>Out for Repair</option>
					<option<?php if ($status == 'In Progress') print ' selected';?>>In Progress</option>
					<option<?php if ($status == 'Testing') print ' selected';?>>Testing</option>
					<option<?php if ($status == 'Awaiting Authorization') print ' selected';?>>Awaiting Authorization</option>
					<option<?php if ($status == 'Completed') print ' selected';?>>Completed</option>
			</select>			
		<br />
		<table align="center">
			<tr>
				<td align="center">
					<label for="basic"><u>Completion Time:</u></label>
				</td>
			</tr>
			<tr>
				<td align="center">
					<?php 
						if ($status != 'Completed'){
							print "Not Completed";
						} else {
							print $timeTaken;
						}
					?>
				</td>
				<td align="center">
					<a href="#popupBasic" data-rel="popup" data-role="button" data-transition="flow">Delete Item</a>
					<div data-role="popup" data-theme="a" id="popupBasic" class="ui-content">
					<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
						<p>Are you sure you want to delete?</p>
							<a data-role="button" href="edit.php?id=<?php print $id; ?>">No</a>
							<a data-role="button" data-theme="e" href="edit.php?id=<?php print $id; ?>&delete=yes">Yes</a>
						</ul>	
					</div>
				</td>				
			</tr>
			<tr>
			</tr>
		</table>
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
					<input type="hidden" name="emails" value="<?php print $email; ?>">
					<input type="hidden" name="ccemails" value="<?php print $ccemail; ?>">
				<td><input type="submit" name="Update" value="Update" class="button" title="Update inventory item" data-inline="true" data-theme="a"></td>
			</tr>
		</table>
</form>
<?
}
} else {
?>
<!-- Testing View Only -->

<div data-role="dialog">
	<div data-role="header" data-theme="a">
				<h1>View Record #<?php print $id?></h1>
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
				}
				$status = $rs['status'];
	
?>	
	<td><a href="mobilelogin.php?id=<?php print $id;?>">Login to Edit</a></td>
	<br />
<b>
	<br />
		<label for="basic">ID:</label>
</b>
			<label for="basic"><?php print $id?></label>
<b>
	<br />
		<label for="basic">Created:</label>
</b>		
			<label for="basic"><?php print $created?></label>
<b>
	<br />
		<label for="basic">Time Created:</label>
</b>		
			<label for="basic"><?php print $submitTime?></label>			
<b>
	<br />
		<label for="basic">Submitted By:</label>
</b>		
			<label for="basic"><?php print $requestedby?></label>
<b>	
	<br />
		<label for="basic">Email:</label>
</b>
			<label for="basic"><?php print $email?></label>		
	
	<br />
	<br />
		<label for="basic"><b>Priority:</b></label>	
			<?php print $priority;?>
	<br />
		<label for="basic"><b>Assigned To:</b></label>
			<?php print $assignedto;?>	
	<br />
		<label for="basic"><b>Building:</b></label>	
			<?php print $building;?>
	<br />	
		<label for="basic"><b>Room:</b></label>	
			<?php print $room;?>
	<br />	
		<label for="basic"><b>Item:</b></label>
			<?php print $item?>
	<br />
		<?php
			$mystring = $item;
			$mystring = substr($mystring, 0, strpos($mystring, "|"));
			if($mystring != ''){
				$sql_statement = "SELECT inventory.inventory_id, inventory.SN FROM inventory.inventory WHERE SN = '$mystring'";
				$results = mysql_query($sql_statement);
				if ($rs = mysql_fetch_array($results, MYSQL_ASSOC))
				{				
					$inventory_id = $rs['inventory_id'];
					?>		
					<label for="basic"><b>Inventory Item Link:</b></label>
					<br />
						<a href="/inventory/edit.php?inventory_id=<?php echo $inventory_id;?>">Click Here</a>
	
			<?php
				} // End fetch array
			} // End checking for serial number
		?>
	<br />	
	<br />
		<label for="basic"><b>Problem:</b></label>
			<?php print $problem;?>
	<br />	
	<br />
		<label for="basic"><b>Solution:</b></label>
			<?php print $solution;?>
	<br />
	<br />	
		<label for="basic"><b>Status:</b></label>
			<?php print $status;?>
	<br />
		<label for="basic"><b>Completion Time:</b></label>
			<?php 
				if ($status != 'Completed'){
					print "Not Completed";
				} else {
					print $timeTaken;
				}
			?>
	<br />
	<br />
		<input type="button" value="Back" class="button" title="Go back" onclick="javascript:location.href='index.php'">
		<input type="button" value="Edit" class="button" title="Login to Edit" onclick="javascript:location.href='mobilelogin.php?id=<?php print $id;?>'">		

<!--<div data-role="dialog">
	<div data-role="header" data-theme="a">
				<h1>You're Not Logged in!</h1>
		</div><!-- /header
		<div data-role="content">
	<p>Incorrect!</p>
		<script language="javascript"><!--
		location.replace("mobilelogin.php?id=<?php //print $id;?>")
		//
		</script>
	</div>
	</div>
	-->
<?
}
}
include_once 'footer.php';
?>

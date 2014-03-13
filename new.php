<?php
include 'header1.php';

if ($_POST['building']){ $building = $_POST['building'];}
if ($_POST['room']){ $room = $_POST['room'];}
if ($_POST['item']){ $item = $_POST['item'];}
if ($_POST['email']){ $email = $_POST['email'];}
if ($_POST['name']){ $name = $_POST['name'];}
if ($_POST['problem']){ $problem = $_POST['problem'];}

?>
<script language="JavaScript" type="text/javascript">
<!--
	function sendForm() {
		document.building.submit();
	}

// Hide submit button until form complete	
//<![CDATA[
$(window).load(function(){

$('#name, #email, #problem').bind('keyup', function() {
    if(allFilled() && problemFilled()) $('#register').removeAttr('disabled');
});

function allFilled() {
    var inputfilled = true;
    $('body textarea').each(function() {
        if($(this).val() == '') inputfilled = false;
    });
    return inputfilled;
}

function problemFilled() {
    var problem = true;
    $('body input').each(function() {
        if($(this).val() == '') problem = false;
    });
    return problem;
}
});
//]]>

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

// Email Validation Function
function validateEmail(sText) {
  var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
  return regex.test(sText);
}

// Check the form
function checkForm () {
	TheForm = (document.add)
	// Check for Common Name
	if (TheForm.common_name.value==""){
		alert("Please enter the Common Name.\ne.g.: HS-Tech-99")
		TheForm.common_name.focus();
		return false;
	}
	
		// Check for Serial Number
	if (TheForm.sn.value==""){
		alert("Please enter the Serial Number.\ne.g.: a2431")
		TheForm.sn.focus();
		return false;
	}
	
	// Check to see that a building has been selected
	if (TheForm.building.selectedIndex==0){
		alert("Please select a building.\ne.g.: High School")
		TheForm.building.focus();
		return false;
	}
	
	// Check for a room
	if (TheForm.room.value==""){
		alert("Please enter a room.\ne.g.: Office")
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
<div data-role="dialog">
		<div data-role="header" data-theme="a">
				<h1>Submit Workorder</h1>
		</div><!-- /header -->	
		<div data-role="content" class="mybg">
		<label for="basic"><b>Fill out the form, then click submit:</b></label><br />
		<label for="basic"><i>Note you will not be able to submit with blank fields</i></label>
		<br />
		<br />
<?php 
if ($_POST['building']) {
	?>	
		<label for="basic"><b>Building:</b></label>
			<label for="basic"><?php echo $building; ?></label>
			<br />
	<?php

	if ($_POST['room']) {
		?>
		<label for="basic"><b>Room: </b></label>	
			<label for="basic"><?php echo $room; ?></label>
			<br />
		<?php
	
		if ($_POST['item']) {
			?>
			<label for="basic"><b>Item:</b></label>
				<label for="basic"><?php echo $item; ?></label>
				<br />
				<br />
			<form action="update.php" method="post" name="add" onSubmit="return checkForm();">
			<input type="hidden" name="action" value="save">
				<tr>
					<td>
						<label for="basic"><b>Your Name:</b></label>
					</td>
					<td>
						<input type="text" id="name" name="requestedby" required="required" value="<?php echo $name; ?>" data-mini="true" maxlength="255" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="basic"><b>Email</b> <i>(@smithville.k12.mo.us)</i><b>:</b></label>
					</td>
					<td>
						<input type="text" id="email" maxlength="9" name="email" required="required" value="<?php echo $email; ?>" data-mini="true" maxlength="255" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="basic"><b>Priority:</b></label>
					</td>
					<td>
						<select name="priority">
							<option value="4">Low</option>
							<option value="3" selected>Normal</option>
							<option value="2">High</option>
							<option value="1">Alert - Only use if class cannot continue!</option>
							<?php if ($_SESSION['id']) { ?><option value="5">Tech/High</option><?php } ?>
							<?php if ($_SESSION['id']) { ?><option value="6">Tech/Normal</option><?php } ?>
							<?php if ($_SESSION['id']) { ?><option value="7">Tech/Low</option><?php } ?>							
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="basic"><b>Problem:</b></label>
					</td>
					<td>
						<textarea name="problem" id="problem"  required="required" rows="5" cols="30"><?php echo $problem; ?></textarea>				
					</td>
				</tr>
				<?php if ($_SESSION['id']) { ?>
				<tr>
					<td>
						<label for="basic"><b>Need Completed By:</b></label>
					</td>
					<td>
						<input type="date" name="neededBy"/>			
					</td>
				</tr>
				<tr>
					<td>
						<label for="basic"><b>Assigned To:</b></label>
					</td>
					<td>			
						<?php include_once 'common/assignedto.inc.php';?>	
					</td>
				</tr>
				<?php } ?>
			</table>
				<span data-mini="true">
					<input type="hidden" name="building" value="<?php echo $building; ?>">
					<input type="hidden" name="room" value="<?php echo $room; ?>">
					<input type="hidden" name="item" value="<?php echo $item; ?>">
					<input type="button" value="Clear Form" class="button" title="Clear Form" onClick="javascript:location.href='new.php'" data-inline="true">
					<input type="button" value="Cancel" class="button" title="Cancel" onClick="javascript:location.href='index.php'" data-inline="true">
					<input type="submit" name="Submit" value="Submit" class="button" title="Submit work order" id="register" data-inline="true" data-theme="e">	
					
				</span>
			</form>
			
			<?php
			
		} else {
			
		//Populate items
		$query = "SELECT SN, common_name, building, room, hw_type FROM inventory.inventory WHERE building LIKE '".$building."' AND room LIKE '".$room."' ORDER BY hw_type, SN ASC";
		$result = mysql_query($query);

			echo '<form name="building" method="post" onSubmit="new1.php"><br /><label for="basic">When selecting your item, the numbers that are listed are serial numbers of the items.  You can select the correct one by looking for the green sticker on your item.</label></b><select name="item" id="item" onChange="sendForm()"><option value="">Select Item</option>';
			while ($rs = mysql_fetch_assoc($result))
				{
					echo '<option value="' . $rs['SN'] . ' | ' . $rs['hw_type'] . '">' . $rs['hw_type'] . ' | ' . $rs['SN'] . '</option>';
				}
			echo '<option value="PowerSchool">PowerSchool</option><option value="SchoolFusion">SchoolFusion</option><option value="Phones">Phones</option><option value="Document Camera">Document Camera</option>';
			if ($_SESSION['id']) {
			echo '<option value="Cable Run">Cable Run</option><option value="Group Policy / AD">Group Policy / AD</option><option value="Network Switch">Network Switch</option><option value="Wireless AP">Wireless AP</option>';
			}
			echo '<option value="Not Listed">Not Listed - Describe in Comments</option><input type="hidden" name="building" value="'.$building.'"><input type="hidden" name="room" value="'.$room.'">';
			echo '<option value="Not Listed">Not Listed - Describe in Comments</option><input type="hidden" name="building" value="'.$building.'"><input type="hidden" name="room" value="'.$room.'">';
			echo '</select></form>';
			
			mysql_free_result($result);	 
			
		}	
	} else {
	
		//Populate rooms
		$query = "SELECT DISTINCT location FROM masterphonelist.masterphonelist WHERE Building LIKE '".$building."' ORDER BY location ASC";
		$result = mysql_query($query);

			echo '<form name="building" method="post" onSubmit="changeSite2.php"><select name="room" id="room" onChange="sendForm()"><option value="">Select Room</option>';
			while ($rs = mysql_fetch_assoc($result))
				{
					echo '<option value="' . $rs['location'] . '">' . $rs['location'] . '</option>';
				}
			echo '<option value="Not Listed">Not Listed - Describe in Comments</option><input type="hidden" name="building" value="'.$building.'">';
			echo '</select></form>';
			
			mysql_free_result($result);	 
	}
	
} else {
?>
	<form name="building" method="post" onSubmit="changeSite2.php">
		<select name="building" onChange="sendForm()">
			<option value="">Select Building</option>
			<option value="High">High</option>
			<option value="Middle">Middle</option>
			<option value="Upper">Upper</option>
			<option value="Primary">Primary</option>	
			<option value="Central">Central</option>
		</select>
	</form>
<?php  } 
?>		
		
</div>
</div>
<?php
include_once 'footer1.php';
include_once 'common/end.inc.php';
?>

<?php
include_once 'header.php';

//Load variables with data...
$tech_email = 'tech.txt@smithville.k12.mo.us';
//$tech_email = 'fletcher@smithville.k12.mo.us';
if ($_POST['id']){	$id = (int)$_POST['id'];}
if ($_POST['action']){	$action = $_POST['action'];}
if ($_POST['delete']){	$delete = $_POST['delete'];}
if ($_POST['requestedby']){	$from = $_POST['requestedby'];}
if ($_POST['email']){
	$emailSQL = mysql_real_escape_string($_POST['email']);
	$emailName = htmlentities($emailSQL);
	$emailString = "@smithville.k12.mo.us";
	$email = $emailName.$emailString;
	}
if ($_POST['ccemail']){
	$ccemailSQL = mysql_real_escape_string($_POST['ccemail']);
	$ccemailName = htmlentities($ccemailSQL);
	$ccemailString = "@smithville.k12.mo.us";
	$ccemail = $ccemailName.$ccemailString;
	}
if ($_POST['emails']){$email = $_POST['emails'];}
if ($_POST['ccemails']){$ccemail = $_POST['ccemails'];}
if ($_POST['building']){$building = $_POST['building'];}
if ($_POST['room']){$room = strip_tags($_POST['room']);}
if ($_POST['item']){$item = strip_tags($_POST['item']);}
if ($_POST['item2']){$item2 = strip_tags($_POST['item2']);}
if ($_POST['item3']){$item3 = strip_tags($_POST['item3']);}
if ($_POST['item4']){$item4 = strip_tags($_POST['item4']);}
if ($_POST['item5']){$item5 = strip_tags($_POST['item5']);}
if ($_POST['hardware']){$hardware = (int)$_POST['hardware'];}
if ($_POST['stamp']){$stamp = $_POST['stamp'];}
if ($_POST['neededBy']){$neededBy = $_POST['neededBy'];}
if ($_POST['status']){$status = $_POST['status'];}
if ($_POST['problem']){
	$problemSQL = mysql_real_escape_string($_POST['problem']);
	$problem = htmlentities($problemSQL);
	}
if ($_POST['assignedto']){$assignedto = $_POST['assignedto'];}
if ($_POST['priority']){
	$priority = $_POST['priority'];
	if ($priority == 1) {
		$priority_text = 'Alert';
	}
	if ($priority == 2) {
		$priority_text = 'High';
	}
	if ($priority == 3) {
		$priority_text = 'Normal';
	}
	if ($priority == 4) {
		$priority_text = 'Low';
	}
	if ($priority == 5) {
		$priority_text = 'Tech/Alert';
	}
	if ($priority == 6) {
		$priority_text = 'Tech/High';
	}
	if ($priority == 7) {
		$priority_text = 'Tech/Normal';
	}
	if ($priority == 8) {
		$priority_text = 'Tech/Low';
	}
}
if ($_POST['solution']){
	$solutionSQL = mysql_real_escape_string($_POST['solution']);
	$solution = htmlentities($solutionSQL);
	}
if ($_POST['timeworked']){
	$timeworked = (int)$_POST['timeworked'];
}else{
	$timeworked = '0';
}
if ($status == 'Completed'){$completed = '';}
if ($status == 'Completed'){$completedStamp = '';}

//Validate data...
//Verify the from field isn't blank...
$error = '';
	
//Verify the building field isn't blank...
if ($building == '')
{
	$error = $error . '<li><b>Please select a building.</b><br />e.g.: High School<p>';
}

//Verify the problem field isn't blank...
if ($problem == '')
{
	$error = $error . '<li><b>Please enter the problem!</b><br />e.g.: HELP MY COMPUTER WILL NOT TURN ON!<p>';
}

if ($status == 'Completed')
{

	//Verify a technician has been selected...
	if ($assignedto == '')
	{
		$error = $error . '<li><b>Please select a technician to assign this work order too.</b><br>e.g.: Jane Doe<p>';
	}
	
	//Verify a solution has been entered...
	if ($solution == '')
	{
		$error = $error . '<li><b>Please type whatchya did to fix it!</b><br>e.g.: Plugged it in<p>';
	}	
	
	//Verify the time is a numeric value...
	if (!is_numeric($timeworked))
	{
		$error = $error . '<li><b>Please enter the amount of time spent in minutes.</b><br>e.g.: 30<p>';
	}
}

//Display the error message if there is one...
if ($error)
{
	include_once 'header.php';
?>
	<div data-role="header" data-theme="a" data-inline="true">
		<h6>Error!</h6>
	</div><!-- /header -->	
	<div data-role="content">
	<p>There was an error processing your command!</p>
	<p><?php print $error?></p>
		<script language="javascript"><!--
		setTimeout("top.location.href='index.php'",3000);
		//-->
		</script>
	</div>
<?php
	include_once 'footer.php';
	die;
}

//Begin email setup...
//if ($email_notification)
//{

//}

//Process new work order request...
if ($action == 'save')
{
	if (!$from) {
		include_once 'header.php';
		?>
			<div data-role="header" data-theme="a" data-inline="true">
				<h6>Error!</h6>
			</div><!-- /header -->	
			<div data-role="content">
			<p>There was an error processing your command!</p>
			<p><?php print $error?></p>
				<script language="javascript"><!--
				setTimeout("top.location.href='index.php'",3000);
				//-->
				</script>
			</div>
		<?php
			include_once 'footer.php';
			die;
	}
	if (!$item) {
		include_once 'header.php';
		?>
			<div data-role="header" data-theme="a" data-inline="true">
				<h6>Error!</h6>
			</div><!-- /header -->	
			<div data-role="content">
			<p>You must enter an item!</p>
			<p><?php print $error?></p>
				<script language="javascript"><!--
				setTimeout("top.location.href='index.php'",3000);
				//-->
				</script>
			</div>
		<?php
			include_once 'footer.php';
			die;
	}	
		//Let's process the upload, if there is one
			if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
			{
				$fileName = $_FILES['userfile']['name'];
				$target = "uploads/"; 
				$target = $target . ( $_FILES['userfile']['name']); 
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				$path = $target;

				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

				if(!get_magic_quotes_gpc())
				{
					$fileName = addslashes($fileName);
				}

				$query = "INSERT INTO uploads (name, size, type, content, path ) ".
				"VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$path')";

				mysql_query($query) or die('Error, query failed'); 
				
				//Find out what the id is, so that we can assign it within the work order
				$query1 = "SELECT id FROM uploads ORDER BY id DESC LIMIT 1";
				$result = mysql_query($query1) or die('Error, query failed');
				if ($rs = mysql_fetch_array($result))
				{
					do
					{
						$id = $rs['id'];
					} while ($rs = mysql_fetch_array($result));

				echo "<br>File $fileName uploaded with an id of $id.<br>";					
				}
				mysql_query($query1) or die('Error, query failed'); 
				
				//Build SQL statement to save a request with an upload...
				$sql_statement = "INSERT INTO " . $db_table . " (created, priority, requestedby, email, ccemail, building, room, item, item2, item3, item4, item5, stamp, problem, inventory_id, assignedto, neededBy, attachment_id) VALUES (CURDATE(), " . $priority . ", '" . $from . "', '" . $email . "', '" . $ccemail . "', '" . $building . "', '" . $room . "', '" . $item . "', '" . $item2 . "', '" . $item3 . "', '" . $item4 . "', '" . $item5 . "', NOW(), '" . $problem . "' , '" . $hardware . "' , '" . $assignedto . "', '" . $neededBy . "', '" . $id . "')";
				
				} else {
				
				//Build SQL statement to save a request...
				$sql_statement = "INSERT INTO " . $db_table . " (created, priority, requestedby, email, ccemail, building, room, item, item2, item3, item4, item5, stamp, problem, inventory_id, assignedto, neededBy) VALUES (CURDATE(), " . $priority . ", '" . $from . "', '" . $email . "', '" . $ccemail . "', '" . $building . "', '" . $room . "', '" . $item . "', '" . $item2 . "', '" . $item3 . "', '" . $item4 . "', '" . $item5 . "', NOW(), '" . $problem . "' , '" . $hardware . "' , '" . $assignedto . "', '" . $neededBy . "')";				
			}
			//Debugging...
				if ($debugging)
				{
					print '<b>DEBUG:</b> ' . $sql_statement . '<p>';
				}
				//Execute the built query string
				$execute = mysql_query($sql_statement) or $error_message = "There was an error in your query " . mysql_error();
				
				//Get next id....
				$nextid = mysql_insert_id();

				if ($email_notification)
				{
					require("common/class.phpmailer.php");
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Host = $smtp_server;
				$mail->AddAddress("" . $email ."");
				if ($priority == 1){
					$mail->AddAddress("" . $tech_email ."");
				}
				if ($ccemail) {
					$mail->AddAddress("" . $ccemail ."");
				}
				$mail->AddAddress("" . $admin_email . "");
				//Configure email...
				$mail->From = $email;
				$mail->FromName = $from;
				if ($assignedto == $assigned_to1) $mail->AddAddress($assigned_to_email1, $assigned_to1);
				if ($assignedto == $assigned_to2) $mail->AddAddress($assigned_to_email2, $assigned_to2);
				if ($assignedto == $assigned_to3) $mail->AddAddress($assigned_to_email3, $assigned_to3);
				if ($assignedto == $assigned_to4) $mail->AddAddress($assigned_to_email4, $assigned_to4);
				if ($assignedto == $assigned_to5) $mail->AddAddress($assigned_to_email5, $assigned_to5);
				if ($assignedto == $assigned_to6) $mail->AddAddress($assigned_to_email6, $assigned_to6);
				if ($priority == 1){
					$link = "http://help.smithville.k12.mo.us/helpdesk/medit.php?id=" . $nextid . "";
					$mail->Subject = " Alert WO";
					$mail->Body .= " Click link to claim: " . $link . "\r\n";
					$mail->Body .= "From: " . $from . "\r\n";
					$mail->Body .= "Building: " . stripslashes($building) . "\r\n";
					$mail->Body .= "Room: " . stripslashes($room) . "\r\n";
					$mail->Body .= "Problem: " . $problem . "\r\n";
				} else {
					$mail->Subject = "New WO #".$nextid;
					$mail->Body = "Priority: " . $priority_text . "\r\n";
					$mail->Body .= "From: " . $from . "\r\n";
					$mail->Body .= "Building: " . stripslashes($building) . "\r\n";
					$mail->Body .= "Room: " . stripslashes($room) . "\r\n";
					$mail->Body .= "Item: " . stripslashes($item) . "\r\n";
					$mail->Body .= "Problem: " . $problem . "\r\n";
					$mail->Body .= $base_url."/edit.php?id=" . $nextid . "\r\n";
				}
			}
		}

//Process updated work order request...
if (($action == 'update') AND ($delete != 'yes'))
{
		//Let's process the upload, if there is one
			if($_POST['upload'] && $_FILES['userfile']['size'] > 0)
			{
				$fileName = $_FILES['userfile']['name'];
				$target = "uploads/"; 
				$target = $target . ( $_FILES['userfile']['name']); 
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				$path = $target;

				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

				if(!get_magic_quotes_gpc())
				{
					$fileName = addslashes($fileName);
				}

				$query = "INSERT INTO uploads (name, size, type, content, path ) ".
				"VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$path')";

				mysql_query($query) or die('Error, query failed'); 
				
				//Find out what the id is, so that we can assign it within the work order
				$query1 = "SELECT id FROM uploads ORDER BY id DESC LIMIT 1";
				$result = mysql_query($query1) or die('Error, query failed');
				if ($rs = mysql_fetch_array($result))
				{
					do
					{
						$uid = $rs['id'];
					} while ($rs = mysql_fetch_array($result));

				echo "<br>File $fileName uploaded with an id of $uid.<br>";					
				}
				mysql_query($query1) or die('Error, query failed'); 

				//Build SQL statement to update a request with an upload...
				$sql_statement = "UPDATE " . $db_table . " SET priority = $priority, requestedby = '" . $from . "', ccemail = '" . $ccemail . "', building='" . $building . "', room = '" . $room . "', item = '" . $item . "', item2 = '" . $item2 . "', item3 = '" . $item3 . "', item4 = '" . $item4 . "', item5 = '" . $item5 . "',status = '" . $status . "', problem='" . $problem . "', solution='" . $solution . "', assignedto = '" . $assignedto . "', inventory_id='" . $hardware . "', neededBy = '" . $neededBy . "', attachment_id = '" . $uid . "'";
				if ($timeworked) $sql_statement .= ", timeworked = " . $timeworked;
				if ($status == 'Completed') $sql_statement .= ", completed = CURDATE(), completedStamp = NOW()";
				$sql_statement .= " WHERE id = " . $id . ";";

				} else {
				
				//Build SQL statement to update a request...
				$sql_statement = "UPDATE " . $db_table . " SET priority = $priority, requestedby = '" . $from . "', ccemail = '" . $ccemail . "', building='" . $building . "', room = '" . $room . "', item = '" . $item . "', item2 = '" . $item2 . "', item3 = '" . $item3 . "', item4 = '" . $item4 . "', item5 = '" . $item5 . "', status = '" . $status . "', problem='" . $problem . "', solution='" . $solution . "', assignedto = '" . $assignedto . "', inventory_id='" . $hardware . "', neededBy = '" . $neededBy . "'";
				if ($timeworked) $sql_statement .= ", timeworked = " . $timeworked;
				if ($status == 'Completed') $sql_statement .= ", completed = CURDATE(), completedStamp = NOW()";
				$sql_statement .= " WHERE id = " . $id . ";";
				
			}
				
			//Debug...
			if ($debugging)
			{
				print '<b>DEBUG:</b> ' . $sql_statement . '<p>';
			}
			//Execute the built query string
			$execute = mysql_query($sql_statement) or $error_message = "There was an error in your query " . mysql_error();
			
			if ($email_notification)
			{
				require("common/class.phpmailer.php");
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Host = $smtp_server;
				$mail->AddAddress("" . $email ."");
				if ($ccemail) {
					$mail->AddAddress("" . $ccemail ."");
				}
				$mail->AddAddress("" . $admin_email . "");
				//Configure email...
				$mail->From = $email;
				$mail->FromName = $from;
				if ($assignedto == $assigned_to1) $mail->AddAddress($assigned_to_email1, $assigned_to1);
				if ($assignedto == $assigned_to2) $mail->AddAddress($assigned_to_email2, $assigned_to2);
				if ($assignedto == $assigned_to3) $mail->AddAddress($assigned_to_email3, $assigned_to3);
				if ($assignedto == $assigned_to4) $mail->AddAddress($assigned_to_email4, $assigned_to4);
				if ($assignedto == $assigned_to5) $mail->AddAddress($assigned_to_email5, $assigned_to5);
				if ($assignedto == $assigned_to6) $mail->AddAddress($assigned_to_email6, $assigned_to6);
				//Configure email...

				if ($priority > 4){
					$problemL = $problem;
								if (strlen($problemL) > 45) 
								{
									$problems = substr($problemL, 0, 45) . "...";
								} else {
									$problems = $problemL;
								}
								
					$mail->Subject = "Tech WO #" . $id . " / " . $status." / ". $problems;
					$mail->Body .= "Solution: " . stripslashes($solution) . "\r\n";
					$mail->Body = "Priority: " . $priority_text . "\r\n";
					$mail->Body .= "From: " . stripslashes($from) . "\r\n";
					$mail->Body .= "Building: " . stripslashes($building) . "\r\n";
					$mail->Body .= "Room: " . stripslashes($room) . "\r\n";
					$mail->Body .= "Item: " . stripslashes($item) . "\r\n";
					$mail->Body .= "Status: " . $status . "\r\n";
					$mail->Body .= "Assigned to: " . stripslashes($assignedto) . "\r\n";
					$mail->Body .= "Problem: " . stripslashes($problem) . "\r\n";
				} else {
					$problemL = $problem;
								if (strlen($problemL) > 45) 
								{
									$problems = substr($problemL, 0, 45) . "...";
								} else {
									$problems = $problemL;
								}
					$mail->Subject = "WO #" . $id . " / " . $status." / ". $problems;
					//Message...
					$mail->Body = "Priority: " . $priority_text . "\r\n";
					$mail->Body .= "From: " . stripslashes($from) . "\r\n";
					$mail->Body .= "Building: " . stripslashes($building) . "\r\n";
					$mail->Body .= "Room: " . stripslashes($room) . "\r\n";
					$mail->Body .= "Item: " . stripslashes($item) . "\r\n";
					$mail->Body .= "Status: " . $status . "\r\n";
					$mail->Body .= "Assigned to: " . stripslashes($assignedto) . "\r\n";
					$mail->Body .= "Problem: " . stripslashes($problem) . "\r\n";
					$mail->Body .= "Solution: " . stripslashes($solution) . "\r\n";
					
				}
				
				$mail->Body .= "http://help.smithville.k12.mo.us/home/edit.php?id=" . $id . "\r\n";
				
				if(!$mail->Send()) {
						  echo "Mailer Error: " . $mail->ErrorInfo;
						} else {
						  echo "Message sent!";
						}
			}
		}

//Process deleted work order request...
if (($action == 'update') AND ($delete == 'yes'))
{
	//Build SQL statement to delete a request...
	$sql_statement = 'DELETE FROM ' . $db_table . ' WHERE id = ' . $id;

	//Debug...
	if ($debugging)
	{
		print '<b>DEBUG:</b> ' . $sql_statement . '<p>';
	}
	//Execute the built query string
	$execute = mysql_query($sql_statement) or $error_message = "There was an error in your query " . mysql_error();

	if ($email_notification)
	{
		//Configure email...
		$mail->From = addslashes($email);
		$mail->FromName = $from;

		//CC technician...
		if ($assignedto == $assigned_to1) $mail->AddCC("" . $assigned_to_email1 ."", "" . $assigned_to1 . "");
		if ($assignedto == $assigned_to2) $mail->AddCC("" . $assigned_to_email2 ."", "" . $assigned_to2 . "");
		if ($assignedto == $assigned_to3) $mail->AddCC("" . $assigned_to_email3 ."", "" . $assigned_to3 . "");
		if ($assignedto == $assigned_to4) $mail->AddCC("" . $assigned_to_email4 ."", "" . $assigned_to4 . "");
		if ($assignedto == $assigned_to5) $mail->AddCC("" . $assigned_to_email5 ."", "" . $assigned_to5 . "");
		if ($assignedto == $assigned_to6) $mail->AddCC("" . $assigned_to_email6 ."", "" . $assigned_to6 . "");
		if ($assignedto == $assigned_to7) $mail->AddCC("" . $assigned_to_email7 ."", "" . $assigned_to7 . "");
		if ($assignedto == $assigned_to8) $mail->AddCC("" . $assigned_to_email8 ."", "" . $assigned_to8 . "");
		if ($assignedto == $assigned_to9) $mail->AddCC("" . $assigned_to_email9 ."", "" . $assigned_to9 . "");
		if ($assignedto == $assigned_to10) $mail->AddCC("" . $assigned_to_email10 ."", "" . $assigned_to10 . "");
	
		if ($priority == 1)
		{
			$mail->Priority = 1;
		}
		$mail->Subject = "WO #" . $id . " - Deleted";
		//Message...
		$mail->Body = "Priority: " . $priority_text . "\r\n";
		$mail->Body .= "From: " . stripslashes($from) . "\r\n";
		$mail->Body .= "Email: " . $email . "\r\n";
		$mail->Body .= "Building: " . stripslashes($building) . "\r\n";
		$mail->Body .= "Room: " . stripslashes($room) . "\r\n";
		$mail->Body .= "Item: " . stripslashes($item) . "\r\n";
		$mail->Body .= "Status: " . $status . "\r\n";
		$mail->Body .= "Assigned to: " . stripslashes($assignedto) . "\r\n";
		$mail->Body .= "Problem: " . stripslashes($problem) . "\r\n";
		$mail->Body .= "Solution: " . stripslashes($solution) . "\r\n";
		$mail->Body .= "Time: " . $timeworked . " min(s).\r\n";
	}
}

if ($email_notification)
{
	if(!$mail->Send())
	{
    	$error_message .= "<li>".$mail->ErrorInfo;
	}
}

if (!$execute)
{
	include_once 'header.php';
?>
	<div data-role="header" data-theme="a" data-inline="true">
		<h6>Error!</h6>
	</div><!-- /header -->	
	<div data-role="content">
	<p>There was an error processing your command!</p>
	<p><?php print $error_message?></p>
		<script language="javascript"><!--
		setTimeout("top.location.href='index.php'",3000);
		//-->
		</script>
	</div>
<?php
	include_once 'footer.php';
} else {
	include_once 'header.php';
?>
	<div data-role="header" data-theme="a" data-inline="true">
		<h6>Success!</h6>
	</div><!-- /header -->	
	<div data-role="content">
	<p>Your Work Order Has Been Updated!</p>
		<script language="javascript"><!--
		setTimeout("self.location.href='index.php'",3000);
		//
		</script>
	</div>
<?php
	include_once 'footer.php';
}

include_once 'footer.php';
?> 

<?php
include_once 'header.php';

//Load variables with data...
$tech_email = 'tech.txt@smithville.k12.mo.us';
if ($_POST['id']){	$id = (int)$_POST['id'];}
if ($_POST['action']){	$action = $_POST['action'];}
if ($_POST['delete']){	$delete = $_POST['delete'];}
if ($_POST['assignedto']){$assignedto = $_POST['assignedto'];}
if ($_POST['email']){$email = $_POST['email'];}
if ($_POST['from']){$from = $_POST['from'];}

//Process updated work order request...
if (($action == 'update') AND ($delete != 'yes'))
{
			
				//Build SQL statement to update a request...
				$sql_statement = "UPDATE " . $db_table . " SET assignedto = '" . $assignedto . "' WHERE id = " . $id . ";";

			//Execute the built query string
			$execute = mysql_query($sql_statement) or $error_message = "There was an error in your query " . mysql_error();
			
			if ($email_notification)
			{
				require("common/class.phpmailer.php");
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Host = $smtp_server;
				$mail->AddAddress("" . $email ."");
				$mail->AddAddress("" . $tech_email ."");
				//Configure email...
				$mail->From = $email;
				$mail->FromName = $from;
				//Configure email...

					$mail->Subject = " WO #" . $id . " claimed";
					//Message...
					$mail->Body = " " . $assignedto . " claimed the WO. \r\n";
					$mail->Body .= "We are on the way.";
					if(!$mail->Send()) {

echo 'Message was not sent.';

echo 'Mailer error: ' . $mail->ErrorInfo;

} else {

echo 'Message has been sent.';

}
				}
			}

if (!$execute)
{
	include_once 'header.php';
?>
<div data-role="dialog">
	<div data-role="header" data-theme="a" data-inline="true">
		<h6>Error!</h6>
	</div><!-- /header -->	
	<div data-role="content">
	<p>There was an error processing your command!</p>
	<p><?php print $error_message?></p>
		<script language="javascript"><!--
		setTimeout("top.location.href='medit.php?id=<?php print $id;?>'",3000);
		//-->
		</script>
	</div>
</div>
<?php
	include_once 'footer.php';
} else {
	include_once 'header.php';
?>
<div data-role="dialog">
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
</div>
<?php
	include_once 'footer.php';
}

include_once 'footer.php';
?> 
